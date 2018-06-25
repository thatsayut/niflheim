<?php

require "vendor/autoload.php";

$access_token = 'kUCEdk/p61dDiIHUxMPLT/04KRcBrxfevLpfhZBLofSSCqPqNPU3xB3dksvKRYYEqbpqdQSw2Z/Sdt8KXQ2ni8NNlHQsdebI0C48PBmwnIBAH51RGXngNCaeRuxsCobem8c39ZxGY/3utEBx7fJcfQdB04t89/1O/w1cDnyilFU=';

$channelSecret = '54520c7810111076eaf0172df6cd5a1a';

$pushID = 'U00d8c4d48c5443e513c09c2f30e409f6';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);


$actions = array (
  // general message action
  New \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("Yes", "yes"),
  New \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("No", "no"),
  // URL type action
  //New \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("Google", "http://www.google.com"),
  // The following two are interactive actions
  //New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("next page", "page=3"),
  //New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("Previous page", "page=1")
);
$img_url = "https://image.ibb.co/k52uuo/cdeadf15_7c66_442c_ab98_223a705e6152.jpg";
$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("Facial Access control", "visitor", $img_url, $actions);
$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("Button template builder", $button);
$response = $bot->pushMessage($pushID, $outputText);

// confriam
// $actions = array (
//   New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("yes", "ans=y"),
//   New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("no", "ans=N")
// );
// $button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("confim message", $actions);
// $outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("confim message", $button);
// $response = $bot->pushMessage($pushID, $outputText);


// Image
// $img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
// $outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
// $response = $bot->pushMessage($pushID, $outputText);

// text
// $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder('hello world');
// $response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







