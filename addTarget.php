<?php

//Entering the data :
	echo '<h1 style="color:3899c3;">Add a target account with a given idAzalead </h1>';
    echo '<form method="post" action="" >';
    echo '<p>';
    echo 'Given access token <br />';
    echo '<input type="text" name="token" />';
    echo '</p>';
    echo '<p>';
    echo 'id Azalead <br />';
    echo '<input type="text" name="idaza" />';
    echo '</p>';
    echo '<p><input type="submit" name="cf-submitted" value="Add to target list"/></p>';
    echo '</form>';

//Submitting your token request to the endpoint /v1/targetaccounts
if ( isset( $_POST['cf-submitted'] ) ) {
	$token = $_POST["token"];
	$data = $_POST["idaza"];

//Endpoint to access
	$url = 'https://azaanalytics.azure-api.net/analytics/v1/targetaccounts/idazalead?access_token='.$token;

//Sending the request to the API 
    $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data))   
        );

//Getting the response from the API 
    $response = curl_exec($ch);
    $decodedData = json_decode($response,true);

    if ($decodedData['success'] == true ) {
	   echo "Company added successfully to target list";
    } else {
	   echo "Could not add this company. Make sure that the company is not in your Excluded list. <br/>";
	   print_r($decodedData);
    }

//echo $decodedData;
    curl_close($ch);

}
?>