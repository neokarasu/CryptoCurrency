<?php

// binance will be refered to as bin for variables

// This is a single api call per page load that brings up the data for all Binance pair rates


$url = "https://www.binance.com/api/v1/ticker/allPrices";
$json = file_get_contents($url);
$bin_data = json_decode($json, TRUE);

// Make an easy usable array containing only the coin names and id (index key) for further use

$bin_list_coin_symbols = array_column($bin_data, 'symbol');

// Get proper id (index key) for interesting coins from the array to use when assigning variables to info from the array

// Warning: using the Ethereum tradepairs for coins that do not have an USDT tradepair. If possible USDT is used.

$bin_cardano_id = array_search('ADAETH', $bin_list_coin_symbols);
$bin_neo_id = array_search('NEOUSDT', $bin_list_coin_symbols);
$bin_vechain_id = array_search('VENETH', $bin_list_coin_symbols);
$bin_bitcoin_id = array_search('BTCUSDT', $bin_list_coin_symbols);
$bin_litecoin_id = array_search('LTCUSDT', $bin_list_coin_symbols);
$bin_ethereum_id = array_search('ETHUSDT', $bin_list_coin_symbols);


// Create variables for the data to be shown in the tables for owned coins

$bin_ada_eth_rate = $bin_data[$bin_cardano_id]["price"];
$bin_ada_symbol = $bin_data[$bin_cardano_id]["symbol"];

$bin_neo_rate = $bin_data[$bin_neo_id]["price"];
$bin_neo_symbol = $bin_data[$bin_neo_id]["symbol"];

$bin_ven_eth_rate = $bin_data[$bin_vechain_id]["price"];
$bin_ven_symbol = $bin_data[$bin_vechain_id]["symbol"];

$bin_btc_rate = $bin_data[$bin_bitcoin_id]["price"];
$bin_btc_symbol = $bin_data[$bin_bitcoin_id]["symbol"];

$bin_ltc_rate = $bin_data[$bin_litecoin_id]["price"];
$bin_ltc_symbol = $bin_data[$bin_litecoin_id]["symbol"];

$bin_eth_rate = $bin_data[$bin_ethereum_id]["price"];
$bin_eth_symbol = $bin_data[$bin_ethereum_id]["symbol"];

$bin_ada_exitamount = $bin_ada_amount - ($bin_ada_withdrawalfee + $ada_transferfee);
$bin_neo_exitamount = $bin_neo_amount - ($bin_neo_withdrawalfee + $neo_transferfee);
$bin_ven_exitamount = $bin_ven_amount - ($bin_ven_withdrawalfee + $ven_transferfee);
$bin_btc_exitamount = $bin_btc_amount - ($bin_btc_withdrawalfee + $btc_transferfee);
$bin_ltc_exitamount = $bin_ltc_amount - ($bin_ltc_withdrawalfee + $ltc_transferfee);

// Special calculation for currencies that use a ETH pair instead of USDT

$bin_ada_rate = $bin_ada_eth_rate * $bin_eth_rate;
$bin_ven_rate = $bin_ven_eth_rate * $bin_eth_rate;

// Continue regular calculations

$bin_ada_exitcost = (0.0025 * ($bin_ada_exitamount * $bin_ada_rate)) + (0.9 * $exchange_EUR_USD );
$bin_neo_exitcost = (0.0025 * ($bin_neo_exitamount * $bin_neo_rate)) + (0.9 * $exchange_EUR_USD );
$bin_ven_exitcost = (0.0025 * ($bin_ven_exitamount * $bin_ven_rate)) + (0.9 * $exchange_EUR_USD );
$bin_btc_exitcost = (0.0025 * ($bin_btc_exitamount * $bin_btc_rate)) + (0.9 * $exchange_EUR_USD );
$bin_ltc_exitcost = (0.0025 * ($bin_ltc_exitamount * $bin_ltc_rate)) + (0.9 * $exchange_EUR_USD );

$bin_ada_totalexit = ($bin_ada_exitamount * $bin_ada_rate) - $bin_ada_exitcost;
$bin_neo_totalexit = ($bin_neo_exitamount * $bin_neo_rate) - $bin_neo_exitcost;
$bin_ven_totalexit = ($bin_ven_exitamount * $bin_ven_rate) - $bin_ven_exitcost;
$bin_btc_totalexit = ($bin_btc_exitamount * $bin_btc_rate) - $bin_btc_exitcost;
$bin_ltc_totalexit = ($bin_ltc_exitamount * $bin_ltc_rate) - $bin_ltc_exitcost;

$bin_ada_profit = ($bin_ada_rate - $bin_ada_buyinrate ) * $bin_ada_amount;
$bin_neo_profit = ($bin_neo_rate - $bin_neo_buyinrate ) * $bin_neo_amount;
$bin_ven_profit = ($bin_ven_rate - $bin_ven_buyinrate ) * $bin_ven_amount;
$bin_btc_profit = ($bin_btc_rate - $bin_btc_buyinrate ) * $bin_btc_amount;
$bin_ltc_profit = ($bin_ltc_rate - $bin_ltc_buyinrate ) * $bin_ltc_amount;

$bin_ada_percent_profit = ($bin_ada_profit / $bin_ada_totalbuyin) * 100;
$bin_neo_percent_profit = ($bin_neo_profit / $bin_neo_totalbuyin) * 100;
$bin_ven_percent_profit = ($bin_ven_profit / $bin_ven_totalbuyin) * 100;
$bin_btc_percent_profit = ($bin_btc_profit / $bin_btc_totalbuyin) * 100;
$bin_ltc_percent_profit = ($bin_ltc_profit / $bin_ltc_totalbuyin) * 100;

$bin_ada_exitprofit = $bin_ada_totalexit - $bin_ada_totalbuyin;
$bin_neo_exitprofit = $bin_neo_totalexit - $bin_neo_totalbuyin;
$bin_ven_exitprofit = $bin_ven_totalexit - $bin_ven_totalbuyin;
$bin_btc_exitprofit = $bin_btc_totalexit - $bin_btc_totalbuyin;
$bin_ltc_exitprofit = $bin_ltc_totalexit - $bin_ltc_totalbuyin;

$bin_ada_percent_exitprofit = ($bin_ada_exitprofit / $bin_ada_totalbuyin) * 100;
$bin_neo_percent_exitprofit = ($bin_neo_exitprofit / $bin_neo_totalbuyin) * 100;
$bin_ven_percent_exitprofit = ($bin_ven_exitprofit / $bin_ven_totalbuyin) * 100;
$bin_btc_percent_exitprofit = ($bin_btc_exitprofit / $bin_btc_totalbuyin) * 100;
$bin_ltc_percent_exitprofit = ($bin_ltc_exitprofit / $bin_ltc_totalbuyin) * 100;

$bin_total_profit = $bin_ada_profit + $bin_neo_profit + $bin_ven_profit + $bin_btc_profit + $bin_ltc_profit;
$bin_total_percent_profit = ($bin_total_profit / ($bin_ada_totalbuyin + $bin_neo_totalbuyin + $bin_ven_totalbuyin + $bin_btc_totalbuyin + $bin_ltc_totalbuyin)) * 100;
$bin_total_exitprofit = $bin_ada_exitprofit + $bin_neo_exitprofit + $bin_ven_exitprofit + $bin_btc_exitprofit + $bin_ltc_exitprofit;
$bin_total_percent_exitprofit = ($bin_total_exitprofit / ($bin_ada_totalbuyin + $bin_neo_totalbuyin + $bin_ven_totalbuyin + $bin_btc_totalbuyin + $bin_ltc_totalbuyin)) * 100;
?>