<?php 

// This is a single api call per page load that brings up latest exchange data between EUR and USD, using EUR as base

$url = "https://api.fixer.io/latest?symbols=USD";
$json = file_get_contents($url);
$exchangedata_EUR_USD = json_decode($json, TRUE);
$exchange_EUR_USD = $exchangedata_EUR_USD["rates"]["USD"];

?>