<?php

require "vendor/autoload.php";

$access_token = 'kUCEdk/p61dDiIHUxMPLT/04KRcBrxfevLpfhZBLofSSCqPqNPU3xB3dksvKRYYEqbpqdQSw2Z/Sdt8KXQ2ni8NNlHQsdebI0C48PBmwnIBAH51RGXngNCaeRuxsCobem8c39ZxGY/3utEBx7fJcfQdB04t89/1O/w1cDnyilFU=';

$channelSecret = '54520c7810111076eaf0172df6cd5a1a';

$pushID = 'U00d8c4d48c5443e513c09c2f30e409f6';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

// $actions = array (
//   New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("yes", "ans=y"),
//   New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("no", "ans=N")
// );
// $img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
// $button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("confim message", "description", $img_url ,$actions);
// $outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("confim message", $button);
// $response = $bot->pushMessage($pushID, $outputText);

$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
$outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
$response = $bot->pushMessage($pushID, $outputText);

// text
// $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder('hello world');
// $response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







