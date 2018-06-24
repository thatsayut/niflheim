<?php


$access_token = 'kUCEdk/p61dDiIHUxMPLT/04KRcBrxfevLpfhZBLofSSCqPqNPU3xB3dksvKRYYEqbpqdQSw2Z/Sdt8KXQ2ni8NNlHQsdebI0C48PBmwnIBAH51RGXngNCaeRuxsCobem8c39ZxGY/3utEBx7fJcfQdB04t89/1O/w1cDnyilFU=';

$userId = 'U00d8c4d48c5443e513c09c2f30e409f6';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

