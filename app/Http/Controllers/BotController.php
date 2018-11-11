<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    public function reply(Request $request){
    	Log::debug("testtttttttttttttttttttttttttttttt");
    	Log::debug($request);
    	$replyToken = $request['events']['0']['replyToken'];
        $client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $bot = new LINEBot($client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        $textMessageBuilder = new TextMessageBuilder('hello');
        $bot->replyText($replyToken, $textMessageBuilder);
    }
}
