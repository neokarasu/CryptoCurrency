<?php 

// This is a single api call per page load that brings up latest exchange data between EUR and USD, using EUR as base

$url = "https://openexchangerates.org/api/latest.json?app_id=$openexchangerates_apikey";
$json = file_get_contents($url);
$exchangedata_USD_EUR = json_decode($json, TRUE);
$exchange_USD_EUR = $exchangedata_USD_EUR["rates"]["EUR"];
$exchange_EUR_USD = 1 / $exchange_USD_EUR;
?>
