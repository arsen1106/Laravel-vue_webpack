<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings;
use GuzzleHttp\Client;
use Telegram;

class SettingsController extends Controller
{
    public $telegram_bot_url = 'https://api.telegram.org/bot';
    public $telegram_bot_token;

    public function __construct()
    {
        $this->telegram_bot_token = Telegram::getAccessToken();
    }

    public function index()
    {
        return view('backend.setting',Settings::getSettings());
    }

    public function store( Request $request )
    {
        Settings::where('key','!=',null)->delete();
        foreach ($request->except('_token') as $key => $value){
            $setting = new Settings();
            $setting->key = $key;
            $setting->value = $value;
            $setting->save();
        }
        return redirect()->route('admin.setting.index');
    }

    public function setwebhook(Request $request)
    {
        $webHookURL = 'https://145e1c52fed8.ngrok.io/'  . $this->telegram_bot_token .'/';
        $result = $this->sendTelegramData('setWebhook',[
           'query' => ['url' => $webHookURL]
        ]);
        return redirect()->route('admin.setting.index')->with('status',$result);
    }

    public function getwebhookinfo(Request $request)
    {
        $result = $this->sendTelegramData('getWebhookInfo');
        return redirect()->route('admin.setting.index')->with('status',$result);
    }

    public function sendTelegramData( $route ='' ,$params = [], $method = 'post')
    {
        $client = new Client(['base_uri' => $this->telegram_bot_url . $this->telegram_bot_token .'/' ]);
        $result = $client->request($method,$route,$params);
        return (string)$result->getBody();
    }
}
