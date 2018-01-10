<?php

// bitfinex will be refered to as bfn for variables

// This is a single api call per page load that brings up the tradepairs from bitfinex
// $url = "https://api.bitfinex.com/v1/symbols";
// $json = file_get_contents($url);
// $bfn_data = json_decode($json, TRUE);

// These are several API calls that bring up the rate for predefined currency pairs

$url = "https://api.bitfinex.com/v1/pubticker/bchusd";
$json = file_get_contents($url);
$bfn_bch_data = json_decode($json, TRUE);

$url = "https://api.bitfinex.com/v1/pubticker/etcusd";
$json = file_get_contents($url);
$bfn_etc_data = json_decode($json, TRUE);

$url = "https://api.bitfinex.com/v1/pubticker/iotusd";
$json = file_get_contents($url);
$bfn_iota_data = json_decode($json, TRUE);

$url = "https://api.bitfinex.com/v1/pubticker/xmrusd";
$json = file_get_contents($url);
$bfn_xmr_data = json_decode($json, TRUE);

$url = "https://api.bitfinex.com/v1/pubticker/xrpusd";
$json = file_get_contents($url);
$bfn_xrp_data = json_decode($json, TRUE);

// Create variables for the data to be shown in the tables for owned coins

$bfn_bch_rate = $bfn_bch_data["mid"];
$bfn_etc_rate = $bfn_etc_data["mid"];
$bfn_iota_rate = $bfn_iota_data["mid"];
$bfn_xmr_rate = $bfn_xmr_data["mid"];
$bfn_xrp_rate = $bfn_xrp_data["mid"];

$bfn_bch_exitamount = $bfn_bch_amount - ($bfn_bch_withdrawalfee + $bch_transferfee);
$bfn_etc_exitamount = $bfn_etc_amount - ($bfn_etc_withdrawalfee + $etc_transferfee);
$bfn_iota_exitamount = $bfn_iota_amount - ($bfn_iota_withdrawalfee + $iota_transferfee);
$bfn_xmr_exitamount = $bfn_xmr_amount - ($bfn_xmr_withdrawalfee + $xmr_transferfee);
$bfn_xrp_exitamount = $bfn_xrp_amount - ($bfn_xrp_withdrawalfee + $xrp_transferfee);

$bfn_bch_exitcost = (0.0025 * ($bfn_bch_exitamount * $bfn_bch_rate)) + (0.9 * $exchange_EUR_USD );
$bfn_etc_exitcost = (0.0025 * ($bfn_etc_exitamount * $bfn_etc_rate)) + (0.9 * $exchange_EUR_USD );
$bfn_iota_exitcost = (0.0025 * ($bfn_iota_exitamount * $bfn_iota_rate)) + (0.9 * $exchange_EUR_USD );
$bfn_xmr_exitcost = (0.0025 * ($bfn_xmr_exitamount * $bfn_xmr_rate)) + (0.9 * $exchange_EUR_USD );
$bfn_xrp_exitcost = (0.0025 * ($bfn_xrp_exitamount * $bfn_xrp_rate)) + (0.9 * $exchange_EUR_USD );

$bfn_bch_totalexit = ($bfn_bch_exitamount * $bfn_bch_rate) - $bfn_bch_exitcost;
$bfn_etc_totalexit = ($bfn_etc_exitamount * $bfn_etc_rate) - $bfn_etc_exitcost;
$bfn_iota_totalexit = ($bfn_iota_exitamount * $bfn_iota_rate) - $bfn_iota_exitcost;
$bfn_xmr_totalexit = ($bfn_xmr_exitamount * $bfn_xmr_rate) - $bfn_xmr_exitcost;
$bfn_xrp_totalexit = ($bfn_xrp_exitamount * $bfn_xrp_rate) - $bfn_xrp_exitcost;

$bfn_bch_profit = ($bfn_bch_rate - $bfn_bch_buyinrate ) * $bfn_bch_amount;
$bfn_etc_profit = ($bfn_etc_rate - $bfn_etc_buyinrate ) * $bfn_etc_amount;
$bfn_iota_profit = ($bfn_iota_rate - $bfn_iota_buyinrate ) * $bfn_iota_amount;
$bfn_xmr_profit = ($bfn_xmr_rate - $bfn_xmr_buyinrate ) * $bfn_xmr_amount;
$bfn_xrp_profit = ($bfn_xrp_rate - $bfn_xrp_buyinrate ) * $bfn_xrp_amount;

$bfn_bch_percent_profit = ($bfn_bch_profit / $bfn_bch_totalbuyin) * 100;
$bfn_etc_percent_profit = ($bfn_etc_profit / $bfn_etc_totalbuyin) * 100;
$bfn_iota_percent_profit = ($bfn_iota_profit / $bfn_iota_totalbuyin) * 100;
$bfn_xmr_percent_profit = ($bfn_xmr_profit / $bfn_xmr_totalbuyin) * 100;
$bfn_xrp_percent_profit = ($bfn_xrp_profit / $bfn_xrp_totalbuyin) * 100;

$bfn_bch_exitprofit = $bfn_bch_totalexit - $bfn_bch_totalbuyin;
$bfn_etc_exitprofit = $bfn_etc_totalexit - $bfn_etc_totalbuyin;
$bfn_iota_exitprofit = $bfn_iota_totalexit - $bfn_iota_totalbuyin;
$bfn_xmr_exitprofit = $bfn_xmr_totalexit - $bfn_xmr_totalbuyin;
$bfn_xrp_exitprofit = $bfn_xrp_totalexit - $bfn_xrp_totalbuyin;

$bfn_bch_percent_exitprofit = ($bfn_bch_exitprofit / $bfn_bch_totalbuyin) * 100;
$bfn_etc_percent_exitprofit = ($bfn_etc_exitprofit / $bfn_etc_totalbuyin) * 100;
$bfn_iota_percent_exitprofit = ($bfn_iota_exitprofit / $bfn_iota_totalbuyin) * 100;
$bfn_xmr_percent_exitprofit = ($bfn_xmr_exitprofit / $bfn_xmr_totalbuyin) * 100;
$bfn_xrp_percent_exitprofit = ($bfn_xrp_exitprofit / $bfn_xrp_totalbuyin) * 100;

$bfn_total_profit = $bfn_bch_profit + $bfn_etc_profit + $bfn_iota_profit + $bfn_xmr_profit + $bfn_xrp_profit;
$bfn_total_percent_profit = ($bfn_total_profit / ($bfn_bch_totalbuyin + $bfn_etc_totalbuyin + $bfn_iota_totalbuyin + $bfn_xmr_totalbuyin + $bfn_xrp_totalbuyin)) * 100;
$bfn_total_exitprofit = $bfn_bch_exitprofit + $bfn_etc_exitprofit + $bfn_iota_exitprofit + $bfn_xmr_exitprofit + $bfn_xrp_exitprofit;
$bfn_total_percent_exitprofit = ($bfn_total_exitprofit / ($bfn_bch_totalbuyin + $bfn_etc_totalbuyin + $bfn_iota_totalbuyin + $bfn_xmr_totalbuyin + $bfn_xrp_totalbuyin)) * 100;

?>