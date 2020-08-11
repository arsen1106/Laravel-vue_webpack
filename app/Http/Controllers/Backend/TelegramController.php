<?php

namespace App\Http\Controllers\Backend;

use App\Question;
use App\Quiz;
use App\TelegramCommands;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TelegramUsers;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    //
    protected $updates;
    protected $telegramUser;

    public  function __construct()
    {
        $this->updates = Telegram::getWebhookUpdates()['message'];
        $this->telegramUser = $this->findTelegramUser();
    }

    public function recycleText( $text )
    {
        $message = sprintf("%s".PHP_EOL,'Please choose any right answer');
        $command = TelegramCommands::orderBy('id','desc')->first();
        if( $command && $command->command == TelegramCommands::COMMAND_QUIZ ){
            $this->runQuiz( $text ,$message);
        }
        $this->sendMessage( $message );
    }

    public function runQuiz( $text ,&$message)
    {
        if( in_array($text,['Yes','No','Begin','Skip'])){

             if( $text == 'No' || $text == 'Skip' ) {
                 Quiz::where('telegram_user_id', $this->telegramUser->id)->delete();
                 $message = sprintf("%s".PHP_EOL,'Thanks');
                 return;
             }
             if( $text == 'Yes' && $this->telegramUser->lastQuiz->isCompleted){
                 Quiz::where('telegram_user_id', $this->telegramUser->id)->delete();
                 Quiz::create([
                     'telegram_user_id' => $this->telegramUser->id,
                     'current_question_id' => Quiz::firtsQuestionId(),
                     'action' => 1,
                 ]);
             }
             $this->telegramUser->lastQuiz->action = 0;
             $this->telegramUser->lastQuiz->save();
             $message = $this->generateAnswer($this->telegramUser->lastQuiz->currentQuestion);
        }
        else{
            $answers =  $this->telegramUser->lastQuiz->currentQuestion->answers;
            foreach ($answers as $key => $answer){
                if( strtoupper($text) == $answer->key ){
                    if( is_null($this->telegramUser->lastQuiz->getNextQuestion()) ){
                        $this->telegramUser->lastQuiz->isCompleted = 1;
                        $message = sprintf("%s".PHP_EOL,'You will receive the answer in 10 days');
                    }
                    $this->telegramUser->lastQuiz->answer_id = $answer->id;
                    $this->telegramUser->lastQuiz->save();
                    if( $this->telegramUser->lastQuiz->isCompleted ) break;
                    $quiz = Quiz::create([
                        'telegram_user_id' => $this->telegramUser->id,
                        'current_question_id' => $this->telegramUser->lastQuiz->getNextQuestion()->id,
                        'action' => 0
                    ]);
                    $message = $this->generateAnswer($quiz->currentQuestion);break;
                }
            }
        }
    }

    public function generateAnswer( Question $question )
    {
        $text = sprintf("%s".PHP_EOL.PHP_EOL,$question->question);
        $answers = $question->answers;
        foreach ( $answers as $key => $answer ){
            $text .= sprintf("%s: %s".PHP_EOL,$answer->key,$answer->option);
        }
        return $text;
    }

    public function sendMessage( $message )
    {
        return Telegram::sendMessage([
            'chat_id' => $this->telegramUser->id,
            'text' => $message,
        ]);
    }

    public function webhook()
    {
        if( mb_substr($this->updates['text'], 0, 1) == Quiz::FIRST_CHAR ){
            TelegramCommands::create([
                'command' => $this->updates['text']
            ]);
            return Telegram::commandsHandler(true);
        }

        $this->recycleText( $this->updates['text'] );

    }

    /**
     * check if has not telegram user in out Db save him
     * @return App\Models\TelegramUsers;
     */
    public function findTelegramUser()
    {
        $user  = TelegramUsers::find($this->updates['from']['id']);
        if( is_null($user) ){
            $user = TelegramUsers::create(json_decode($this->updates['from'],true));
        }
        return $user;
    }

}
