<?php

// ====================
// Get the exchange rates between Dollars and Euros with 1 API call per page load
// ====================

// Add the necessary URL, perform the requestand make a usable variable out of the response with USD as base

$fiatExchangeUrl = 'https://openexchangerates.org/api/latest.json?app_id=' . $openExchangeRatesApiKey . '&symbols=EUR';
$fiatExchangeResponse = curl_get_contents($fiatExchangeUrl);
$fiatExchangeArray = json_decode($fiatExchangeResponse, TRUE);
$fiatExchangeDataUSD = $fiatExchangeArray['rates']['EUR'];

?>
