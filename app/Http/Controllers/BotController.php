<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use Illuminate\Support\Facades\Log;
use App\Line;
use App\Boss;

class BotController extends Controller
{
    public function reply(Request $request){
    	
    	$replyToken = $request['events']['0']['replyToken'];

        $client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $bot = new LINEBot($client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        $text = $request['events']['0']['message']['text'];
        $arr = explode(" ",$text);
        $result = '';
        $command = $arr[0];
        $boss = Boss::find(1);
        if($boss->active == 0 ){
	        if($command == 'load' ){
	        	$line = Line::where('key','like',$arr[1])->first();
	        	Log::debug($line);
	        	if($line != null){
	        		$result = $line->value;
	        		$response = $bot->replyText($replyToken, $result);
	        		Log::debug('777777');
	        		if ($response->isSucceeded()) {
				    	Log::debug('sucesss xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
					}
					Log::debug($response->getHTTPStatus() . ' ' . $response->getRawBody());
		        }
	        	
	        	Log::debug('load load load load load load load load load load load load load load load load load load load load load load load load');
	        	return;
	        } elseif($command == 'save'){
	        	$line = new Line();
	        	$line->key = $arr[1];
	        	$line->value = $arr[2];
	        	$line->save();
	        	Log::debug('save save save save save save save save save save save save save save save save save save save save save save save save');
	        	return;
	        } elseif($command == 'Boss'){
	        	$boss->active = 1;
	    		$boss->save();
	    		$result = 'asdajsdlkajsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas djas ldjakls djkl jsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas d jsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas d jsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas d jsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas d jsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas d jsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas d jsk jaklsdjalk jklasjd klal klajkld ajslkdjak l sdjklla djkla jkdal sjkdlas djlla jdals djkalsjdkl aksdl ajskdll jaklsjadl ljlklaksdjs laks jdklas d';
	    		$response = $bot->replyText($replyToken, $result);
	    		if ($response->isSucceeded()) {
			    	Log::debug('sucesss xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
				}
				Log::debug($response->getHTTPStatus() . ' ' . $response->getRawBody());
	    		Log::debug('BOSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS SSSSSSSSSSSS S S S S S S S  S S '); 
	    		return;
	        }
	    } else {
	    	if($command == 'NoBoss'){
	    		$boss->active = 0;
	    		$boss->save();
	    		$result = 'Ok';
	    		$response = $bot->replyText($replyToken, $result);
	    		if ($response->isSucceeded()) {
			    	Log::debug('sucesss xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
				}
				Log::debug($response->getHTTPStatus() . ' ' . $response->getRawBody());
	        }
	        return;
	    }
	        
	}
}
