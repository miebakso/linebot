<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use Illuminate\Support\Facades\Log;
use App\Line

class BotController extends Controller
{
    public function reply(Request $request){
    	Log::debug($request);
    	$replyToken = $request['events']['0']['replyToken'];
    	Log::debug($replyToken);
        $client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $bot = new LINEBot($client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        $text = $request['events']['0']['message']['text'];
        Log::debug($text);
        $arr = explode(" ",$text);
        $result = '';
        $command = $arr[0];
        if($command == 'load' ){
        	
        } elseif($command == 'save'){

        } elseif($command == 'boss'){

        } elseif($command == 'NoBoss'){
        	
        }
        $response = $bot->replyText($replyToken, $result);
        if ($response->isSucceeded()) {
		    return;
		}
		Log::debug($response->getHTTPStatus());
		Log::debug($response->getRawBody());
	}
}
