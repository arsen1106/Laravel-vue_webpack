<?php

namespace App\Telegram;

/**
 * Class TestCommand.
 */
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class TestCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'test';

    /**
     * @var string Command Description
     */
    protected $description = 'Test command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' =>Actions::TYPING]);
        $user = \App\Models\User::find(1);
//        $this->replyWithMessage(['text' =>'User email in Laravel '.$user->email]);
        $telegram_user = Telegram::getWebhookUpdates()['message'];

        $text = sprintf('%s: %s'.PHP_EOL,'We\'ve created a giant list of questions you can use to build your own quizzes. Every question is designed for maximum engagement and ready to be used right away. ',$telegram_user['from']['id']);
        $text.=sprintf('%s: %s'.PHP_EOL,'To get started press ', 1);

        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];

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

        $messageId = $response->getMessageId();

        return $this->replyWithMessage(compact('text'));

    }
}
