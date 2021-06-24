<?php

// ====================
// Set up timestamp and headers for further use with the Binance API
// ====================

// Get the time in milliseconds as required for the timestamp

list($msec, $sec) = explode(' ', microtime());
$timeMilliSeconds = $sec.substr($msec, 2, 3);

// Set up the headers to use for Binance

$binanceHeaders = [
    'Accepts: application/json',
    "X-MBX-APIKEY: $binanceApiKey"
];



// ====================
// Look up the Binance balances for all cryptocurrencies in your account with 1 API call per page load
// ====================

// Start with adding the necessary url and parameters

$binanceBalanceUrl = 'https://api.binance.com/api/v3/account';
$binanceBalanceParameters = [
    'timestamp' => "$timeMilliSeconds",
];

// Query string encode the parameters, make the signature and then build the request URL

$binanceBalanceQs = http_build_query($binanceBalanceParameters);
$binanceBalanceSignature = hash_hmac('sha256', "$binanceBalanceQs", "$binanceSecretKey");
$binanceBalanceRequest = "$binanceBalanceUrl?$binanceBalanceQs&signature=$binanceBalanceSignature";

// Perform the request and make a usable array out of the response

$binanceBalanceResponse = curl_get_contents($binanceBalanceRequest,$binanceHeaders);
$binanceBalanceArray = json_decode($binanceBalanceResponse,true);

// Extract the data we actually want, rearrange it into a 2-dimensional array with coin names as keys and remove any with amount 0

$binanceBalanceRaw = array_column($binanceBalanceArray['balances'],'free','asset');
$binanceBalanceResult = array_diff($binanceBalanceRaw,array('0.00000000', '0.00'));

// Sort the array by coin names

ksort($binanceBalanceResult);



// ====================
// Look up the Binance withdrawal fees for all cryptocurrencies with 1 API call per page load
// ====================

// Start with adding the necessary url and parameters

$binanceWithdrawalFeeUrl = 'https://api.binance.com/sapi/v1/asset/assetDetail';
$binanceWithdrawalFeeParameters = [
    'timestamp' => "$timeMilliSeconds",
];

// Query string encode the parameters, make the signature and then build the request URL

$binanceWithdrawalFeeQs = http_build_query($binanceWithdrawalFeeParameters);
$binanceWithdrawalFeeSignature = hash_hmac('sha256', "$binanceWithdrawalFeeQs", "$binanceSecretKey");
$binanceWithdrawalFeeRequest = "$binanceWithdrawalFeeUrl?$binanceWithdrawalFeeQs&signature=$binanceWithdrawalFeeSignature";

// Perform the request and make a usable array out of the response

$binanceWithdrawalFeeResponse = curl_get_contents($binanceWithdrawalFeeRequest,$binanceHeaders);
$binanceWithdrawalFeeArray = json_decode($binanceWithdrawalFeeResponse,true);

// Extract the data we actually want and rearrange it into a 2 dimensional array with coin names as keys

foreach($binanceWithdrawalFeeArray  as $key => $value) {
    $binanceWithdrawalFeeResult["$key"] = array_values($value)['0'];
}

// Sort the array by coin names (keys)

ksort($binanceWithdrawalFeeResult);



// ====================
// Pointless to query for the trade fees at Binance since they're not coin-specific.
// Take a default of 0.001 in all cases which is set in input.php
// ====================

?>
