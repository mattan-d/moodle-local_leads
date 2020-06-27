<?php

$url = 'https://dev.moodle37/local/leads/index.php';
$data = array('action' => 'add', 'key2' => 'value2');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
echo 1;
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
print_r($result);
die;

// URL API
$url = 'https://dev.moodle37/local/leads/index.php?action=add';

$client = curl_init();

$json = '{"name":"mattan dor","phone":"0556658940"}';
$json = json_decode($json);
$data = json_encode($json);

$options = array(
    CURLOPT_URL => $url, // Set URL of API
    CURLOPT_CUSTOMREQUEST => "POST", // Set request method
    CURLOPT_RETURNTRANSFER => true, // true, to return the transfer as a string
    CURLOPT_POSTFIELDS => $data, // Send the data in HTTP POST
);

curl_setopt_array($client, $options);

// Execute and Get the response
$response = curl_exec($client);

// Get HTTP Code response
$httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
// Close cURL session
curl_close($client);

// Show response
echo '<h3>HTTP Code</h3>';
echo $httpCode;
echo '<h3>Response</h3>';
print_r($response);

?>