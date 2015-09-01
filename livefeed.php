<?php

//Entering your access token and parameters :

	echo '<h1 style="margin-left:10px;color:3899c3;">Get my Azalead live feed</h1>';
    echo '<form method="get" action="" >';
    echo '<p>';
    echo 'Access token <br />';
    echo '<input type="text" name="token" />';
    echo '</p>';
    echo '<p>';
    echo 'Sort parameter (Examples: date, company_name, company_size, score)<br />';
    echo '<input type="text" name="sort" />';
    echo '</p>';
    echo '<p>';
    echo 'Start parameter <br />';
    echo '<input type="text" name="start" />';
    echo '</p>';
    echo '<p>';
    echo 'Limit parameter <br />';
    echo '<input type="text" name="limit" />';
    echo '</p>';
    echo '<p><input type="submit" name="cf-submitted" value="Get your live feed"/></p>';
    echo '</form></div>';

//Submitting your token request to the endpoint /companyvisitors/livecompanies (List)
if ( isset( $_GET['cf-submitted'] ) ) {

$token = $_GET["token"];
$sort = $_GET["sort"];
$start = $_GET["start"];
$limit = $_GET["limit"];


//Live feed endpoint
$url = 'https://azaanalytics.azure-api.net/analytics/v1/companyvisitors/livecompanies?sort='.
	$sort."&start=".$start."&limit=".$limit."&access_token=".$token;
$data = "";

//Sending the request to the API 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

//Getting the response from the API 
$response = curl_exec($ch);
$decodedData = json_decode($response,true);

//Displaying the result
if (is_array($decodedData[0])) {
	echo "<h2 style='color:3899c3'>Live Feed sample :</h2><br/>";

?>
	<table style="border: 1px solid black;">
		<tr>
			<td><strong>Company Name</strong></td>
			<td><strong>City</strong></td>
			<td><strong>Country</strong></td>
			<td><strong>Last visit</strong></td>
			<td><strong>Score</strong></td>
		</tr>
<?php
	
	for($i=0; $i < count($decodedData);$i ++) {
		
		echo "<tr style='background-color:96BDC1;' ><td>&nbsp;<strong>".$decodedData[$i]['companyName']."</strong>&nbsp;</td>".
		"<td>&nbsp;".$decodedData[$i]['city']."&nbsp;</td><td>"
		.$decodedData[$i]['country']
		."</td><td>&nbsp;"
		.$decodedData[$i]['lastVisit']."&nbsp;</td><td>&nbsp;"
		.$decodedData[$i]['score']."&nbsp;</td>"
		."</tr>";	
	}
	echo "</table>";
} else {
	echo "<h2 style='color:3899c3'>Error :</h2>";
	print_r($response);
}
curl_close($ch);
}
?>