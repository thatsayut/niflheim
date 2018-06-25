<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'kUCEdk/p61dDiIHUxMPLT/04KRcBrxfevLpfhZBLofSSCqPqNPU3xB3dksvKRYYEqbpqdQSw2Z/Sdt8KXQ2ni8NNlHQsdebI0C48PBmwnIBAH51RGXngNCaeRuxsCobem8c39ZxGY/3utEBx7fJcfQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);


$log  = 'User: ten - '.date("Y").PHP_EOL.
"data: ".$content.PHP_EOL.
"-------------------------".PHP_EOL;
file_put_contents('./log_message.text', $log, FILE_APPEND);

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$line_id = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];


			$massage = $event['message']['text'];
			$register = explode(" ",$massage);
			if($register[0] == 'origin'){
				$ch = curl_init();
				$array = array( "line_id"=> $line_id,
					'room' => $register[1],
					'security_code' => md5('viking')
					);
				$data = json_encode($array);
				$url = 'http://codinghubhome.dyndns-office.com:8090/niflheim/visitors/register'; 

				curl_setopt( $ch, CURLOPT_URL, $url );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
				curl_setopt( $ch, CURLOPT_POST, true );
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt($ch, CURLOPT_FAILONERROR, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec ($ch);
				curl_close ($ch);

				$log  = 'User: '.$line_id.' - '.date("F j, Y, g:i a").PHP_EOL.
				"data: ".$server_output.PHP_EOL.
				"-------------------------".PHP_EOL;
				file_put_contents('./log_register.text', $log, FILE_APPEND);

				if($server_output == 'Ok'){
					$text = 'ลงทะเบียนเรียบร้อยแล้ว';
				}else{
					$text = 'มีข้อมูลในระบบแล้ว';
				}

			}else if(strtolower($massage) == 'yes' || strtolower($massage) == 'no'){
				$ch = curl_init();
				$array = array( "line_id"=> $line_id,
					'permission' => $massage,
					'security_code' => md5('viking')
					);
				$data = json_encode($array);
				$url = 'http://codinghubhome.dyndns-office.com:8090/niflheim/visitors/confirm'; 

				curl_setopt( $ch, CURLOPT_URL, $url );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
				curl_setopt( $ch, CURLOPT_POST, true );
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt($ch, CURLOPT_FAILONERROR, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec ($ch);
				curl_close ($ch);

		        $log  = 'User: '.$line_id.' - '.date("F j, Y, g:i a").PHP_EOL.
				"data: ".$server_output.PHP_EOL.
				"-------------------------".PHP_EOL;
				file_put_contents('./log_confirm.text', $log, FILE_APPEND);

				if($server_output != 'Ok'){
					$text = 'เซสชั่นหมดอายุ';
				}else if(strtolower($massage) == 'yes'){
		        	$text = 'ระบบได้เปิดประตูเรียบร้อยแล้ว';
		        }else {
		        	$text = 'ไม่อนุญาติให้เข้า';
		        }
			}



		    if($massage == "สวัสดี"){
		        $text = "สวัสดีจ้าาา";
		    }
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
		if ($event['type'] == 'postback' ){
			$data = $event['postback']['data'];		
			
		}


	}
}
echo "OK";
