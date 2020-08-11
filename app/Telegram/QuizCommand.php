<?php

namespace App\Telegram;

/**
 * Class QuizCommand.
 */
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Quiz;
use Telegram\Bot\Laravel\Facades\Telegram;

class QuizCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'quiz';

    /**
     * @var string Command Description
     */
    protected $description = 'quiz command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' =>Actions::TYPING]);
        $telegram_user = Telegram::getWebhookUpdates()['message'];
        $text = sprintf('%s: %s'.PHP_EOL.PHP_EOL,'We\'ve created a giant list of questions you can use to build your own quizzes. Every question is designed for maximum engagement and ready to be used right away. ',$telegram_user['from']['id']);

        $quiz = Quiz::where('telegram_user_id',$telegram_user['from']['id'])->orderBy('id', 'desc')->first();
        if( empty($quiz) ){
            Quiz::create([
                'telegram_user_id' => $telegram_user['from']['id'],
                'current_question_id' => Quiz::firtsQuestionId(),
                'action' => 1,
            ]);
            $text .=sprintf('%s'.PHP_EOL,'To get started press ');
            $keyboard = [['Begin'], ['Skip']];
        }else{
            if( !$quiz->isCompleted ){
                $text.=sprintf('%s'.PHP_EOL.PHP_EOL,'You haven’t finished the quiz, do you want to continue?');
            }else{
                $text.=sprintf('%s'.PHP_EOL,'Do you want to start the quiz again?');
            }
            $keyboard = [['Yes'], ['No']];
        }
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        $response = Telegram::sendMessage([
            'chat_id' => $telegram_user['from']['id'],
            'text' => 'Hello '.$telegram_user['from']['first_name'],
            'reply_markup' => $reply_markup
        ]);

        return $this->replyWithMessage(compact('text'));

    }
}
