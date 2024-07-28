<?php

function bitrix24_request($method, $params = [])
{
    global $bitrixUrl;
    $url = $bitrixUrl . $method;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true);
}
