<?php

// ====================
// Set up the headers for further use with the CoinMarketCap API
// ====================

$cmcHeaders = [
    'Accepts: application/json',
    "X-CMC_PRO_API_KEY: $coinMarketCapApiKey"
];



// ====================
// Look up the CoinMarketCap IDs for the cryptocurrency symbols with 1 API call per page load
// ====================

// Start with adding the necessary url, parameters and headers

$cmcMapUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/map';
$cmcMapParameters = [
    'symbol' => $cryptoSymbols,
];

// Query string encode the parameters and then build the request URL

$cmcMapQs = http_build_query($cmcMapParameters);
$cmcMapRequest = "$cmcMapUrl?$cmcMapQs";

// Perform the request and make a usable array out of the response

$cmcMapResponse = curl_get_contents($cmcMapRequest,$cmcHeaders);
$cmcMapArray = json_decode($cmcMapResponse,true);

// Get the IDs of the specific symbols from the array and create a comma seperated string of ID's for querying CMC
$cmcIds = implode(',', array_column($cmcMapArray['data'], 'id'));



// ====================
// Look up the CoinMarketCap rates for the cryptocurrency IDs with 1 API call per page load
// ====================

// Start with adding the necessary url and parameters

$cmcRatesUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
$cmcRatesParameters = [
    'id' => $cmcIds,
];

// Query string encode the parameters and then build the request URL

$cmcRatesQs = http_build_query($cmcRatesParameters);
$cmcRatesRequest = "$cmcRatesUrl?$cmcRatesQs";

// Perform the request and make a usable array out of the response

$cmcRatesResponse = curl_get_contents($cmcRatesRequest,$cmcHeaders);
$cmcRatesArray = json_decode($cmcRatesResponse,true);

// Extract the data we want and rearrange it into a 2 dimensional array with coin names as keys

$cmcRatesResult = array_column($cmcRatesArray['data'],'quote','symbol');

foreach($cmcRatesResult as $key => $value) {
    $cmcRatesResult[$key] = array_values($value)[0];
}

// Add names to the arrays instead of having only symbols and remove unnecessary keys and values

$cmcRatesNames = array_column($cmcRatesArray['data'],'name', 'symbol');

foreach($cmcRatesNames as $key => $value) {
    $cmcRates["$key"] = array('name'=> "$cmcRatesNames[$key]") + $cmcRatesResult["$key"];
    unset($cmcRates["$key"]["volume_24h"]);
    unset($cmcRates["$key"]["percent_change_30d"]);
    unset($cmcRates["$key"]["percent_change_60d"]);
    unset($cmcRates["$key"]["percent_change_90d"]);
    unset($cmcRates["$key"]["market_cap"]);
    unset($cmcRates["$key"]["last_updated"]);
}

// Sort the array by coin symbols

ksort($cmcRates);

?>
