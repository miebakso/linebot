<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class BotController extends Controller
{
    public function reply(Request $request){
    	$replyToken = $request['events']['0']['replyToken'];
        $client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $bot = new LINEBot($this->client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        $textMessageBuilder = new TextMessageBuilder('hello');
        $response = $this->bot->replyText($replyToken, $textMessageBuilder);
    }
}
