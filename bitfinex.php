<?php

// ====================
// Set up timestamp as the nonce for further use with the Bitfinex API
// ====================

list($msec, $sec) = explode(' ', microtime());
$timeMilliSeconds = $sec.substr($msec, 2, 3);
$bitfinexNonce = $timeMilliSeconds;



// ====================
// Look up the Bitfinex balances for all cryptocurrencies in your account with 1 API call per page load
// ====================

// Set the necessary urls for the query and for the signature

$bitfinexBalanceUrl = 'https://api.bitfinex.com/v2/auth/r/wallets';
$bitfinexBalanceUrlforSignature = '/api/v2/auth/r/wallets';

// Create the signature

$bitfinexBalanceToSign = $bitfinexBalanceUrlforSignature . $bitfinexNonce;
$bitfinexBalanceSignature = hash_hmac('sha384', utf8_encode($bitfinexBalanceToSign), utf8_encode($bitfinexSecretKey));

// Set up the headers to use for Bitfinex

$bitfinexBalanceHeaders = [
    'content-type: application/json',
    "bfx-nonce: $bitfinexNonce",
    "bfx-apikey: $bitfinexApiKey",
    "bfx-signature: $bitfinexBalanceSignature"
];

// Perform the request and make a usable array out of the response

$bitfinexBalanceResponse = curl_post($bitfinexBalanceUrl,$bitfinexBalanceHeaders, NULL );
$bitfinexBalanceArray = json_decode($bitfinexBalanceResponse,true);

// Extract the data we actually want and rearrange it into a 2-dimensional array with coin names as keys

$bitfinexBalanceResult = array_column($bitfinexBalanceArray,'4','1');

// Sort the array by coin names

ksort($bitfinexBalanceResult);



// ====================
// Look up the Bitfinex withdrawal fees for all cryptocurrencies with 1 public API call per page load
// ====================

// Set the necessary urls for the query and the signature

$bitfinexWithdrawalFeeUrl = 'https://api-pub.bitfinex.com/v2/conf/pub:map:currency:tx:fee';

// Perform the request and make a usable array out of the response

$bitfinexWithdrawalFeeResponse = curl_post($bitfinexWithdrawalFeeUrl);
$bitfinexWithdrawalFeeArray = json_decode($bitfinexWithdrawalFeeResponse,true);

// Extract the data we actually want and rearrange it into a 2 dimensional array with coin names as ke$

$bitfinexWithdrawalFeeResult = array_column($bitfinexWithdrawalFeeArray['0'],'1','0');

foreach($bitfinexWithdrawalFeeResult as $key => $value) {
    $bitfinexWithdrawalFeeResult[$key] = array_values($value)['1'];
}

// Sort the array by coin names (keys)

ksort($bitfinexWithdrawalFeeResult);



// ====================
// Look up the Bitfinex trade fees for all cryptocurrencies with 1 API call per page load
// ====================

// Start with adding the necessary url and parameters

$bitfinexTradeFeeUrl = 'https://api.bitfinex.com/v2/auth/r/summary';
$bitfinexTradeFeeUrlforSignature = '/api/v2/auth/r/summary';

// Create the signature

$bitfinexTradeFeeToSign = $bitfinexTradeFeeUrlforSignature . $bitfinexNonce;
$bitfinexTradeFeeSignature = hash_hmac('sha384', utf8_encode($bitfinexTradeFeeToSign), utf8_encode($bitfinexSecretKey));

// Set up the headers to use for Bitfinex

$bitfinexTradeFeeHeaders = [
    'content-type: application/json',
    "bfx-nonce: $bitfinexNonce",
    "bfx-apikey: $bitfinexApiKey",
    "bfx-signature: $bitfinexTradeFeeSignature"
];

// Perform the request and make a usable array out of the response

$bitfinexTradeFeeResponse = curl_post($bitfinexTradeFeeUrl,$bitfinexTradeFeeHeaders);
$bitfinexTradeFeeArray = json_decode($bitfinexTradeFeeResponse,true);

// Extract the data we actually want and rearrange it into a 2-dimensional array with MakerFee and TakerFee as keys

$bitfinexTradeFeeResult = array_column($bitfinexTradeFeeArray['4'],'0');
$bitfinexKeysForTradeFreeResults = ['MakerFee','TakerFee'];
$bitfinexTradeFeeResult = array_combine($bitfinexKeysForTradeFreeResults, $bitfinexTradeFeeResult);

// Sort the array by maker/taker fee (keys)

ksort($bitfinexTradeFeeResult);

?>
