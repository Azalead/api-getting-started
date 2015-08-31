<?php

//Entering your given access token :

	echo '<h1>Refresh your token</h1>';
    echo '<form method="post" action="" >';

    echo '<p>';
    echo 'Given access token <br />';
    echo '<input type="text" name="token" />';
    echo '</p>';
    echo '<p><input type="submit" name="cf-submitted" value="Get your Refresh token"/></p>';
    echo '</form>';

//Submitting your token request to the endpoint /oauth/token
if ( isset( $_POST['cf-submitted'] ) ) {

$token = $_POST["token"];
$grant_type = "refresh_token";


//Refresh token endpoint
$url = 'https://azaanalytics.azure-api.net/analytics/oauth/token?grant_type='.$grant_type."&refresh_token=".$token;
$data = "";

//Sending the request to the API 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

//Getting the response from the API 
$response = curl_exec($ch);
$decodedData = json_decode($response);
echo $decodedData;

curl_close($ch);

}


?>