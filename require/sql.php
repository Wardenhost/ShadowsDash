<?php
include_once("config.php");

$cpconn = new mysqli($_CONFIG["db_host"], $_CONFIG["db_username"], $_CONFIG["db_password"], $_CONFIG["db_name"] );


//
// Some functions
//
function getclientip() {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) { $ip = $client; }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) { $ip = $forward; }
    else { $ip = $remote; }

    return $ip;
}

function sendLog($channel, $message) {
    $url = "changeme";
    
    $headers = [ 'Content-Type: application/json; charset=utf-8' ];
    $POST = ['content' => $message ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
    $response   = curl_exec($ch);
}
