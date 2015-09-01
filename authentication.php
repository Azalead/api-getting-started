<?php

//Entering your username and password to get an access token :

	echo '<h1>Authenticate to Azalead API</h1>';
    echo '<form method="post" action="" >';
    echo '<p>';
    echo 'Azalead username <br />';
    echo '<input type="text" name="username" />';
    echo '</p>';
    echo '<p>';
    echo 'Azalead password<br />';
    echo '<input type="text" name="password" />';
    echo '</p>';
    echo '<p><input type="submit" name="cf-submitted" value="Get your Access token"/></p>';
    echo '</form>';

//Submitting your token request to the endpoint /oauth/token
if ( isset( $_POST['cf-submitted'] ) ) {

$username = $_POST["username"];
$password = $_POST["password"];
$grant_type = "password";


//Authentication endpoint
$url = 'https://azaanalytics.azure-api.net/analytics/oauth/token?grant_type='.$grant_type."&username=".$username."&password=".$password;
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