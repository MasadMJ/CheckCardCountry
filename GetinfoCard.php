<?php

$card = $_GET['CardNUM'];

$ch = curl_init("https://lookup.binlist.net/".$card);
curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

// Define the array of accepted cards
$cardsACCEPTEdD = array('123456', '7891011');

$passR=0;
$cardCUT = substr($card,0,6);

foreach($cardsACCEPTEdD as $item){
    if(strpos($item, $cardCUT)!== false){
        $passR='1';
    }
}

$response = curl_exec($ch);
$obj = json_decode($response);

if ($obj != null) {
    $country = $obj->country->alpha2;
    $name = $obj->bank->name;
    echo $name, $country;
} else {
    echo "Error: Invalid response.";
}

?>
