<?php

// coinmarketcap will be refered to as cmc for variables

// This is a single api call per page load that brings up the data for the top 1000 coins from coinmarketcap

$url = "https://api.coinmarketcap.com/v1/ticker/?limit=1000";
$json = file_get_contents($url);
$cmc_data = json_decode($json, TRUE);

// Make an easy usable array containing only the coin names and id (index key) for further use

$cmc_list_coin_names = array_column($cmc_data, 'name');

// Get proper id (index key) for interesting coins from the array to use when assigning variables to info from the array

$cmc_bitcoin_id = array_search('Bitcoin', $cmc_list_coin_names);
$cmc_ethereum_id = array_search('Ethereum', $cmc_list_coin_names);
$cmc_ripple_id = array_search('Ripple', $cmc_list_coin_names);
$cmc_litecoin_id = array_search('Litecoin', $cmc_list_coin_names);
$cmc_cardano_id = array_search('Cardano', $cmc_list_coin_names);
$cmc_iota_id = array_search('IOTA', $cmc_list_coin_names);
$cmc_eos_id = array_search('EOS', $cmc_list_coin_names);
$cmc_neo_id = array_search('NEO', $cmc_list_coin_names);
$cmc_verge_id = array_search('Verge', $cmc_list_coin_names);
$cmc_zcash_id = array_search('Zcash', $cmc_list_coin_names);
$cmc_waves_id = array_search('Waves', $cmc_list_coin_names);
$cmc_burst_id = array_search('Burst', $cmc_list_coin_names);
$cmc_wepower_id = array_search('WePower', $cmc_list_coin_names);


// Create variables for the data to be shown in the tables for owned coins

$cmc_btc_rate = $cmc_data[$cmc_bitcoin_id]["price_usd"];
$cmc_btc_percent_change_1h = $cmc_data[$cmc_bitcoin_id]["percent_change_1h"];
$cmc_btc_percent_change_24h = $cmc_data[$cmc_bitcoin_id]["percent_change_24h"];
$cmc_btc_percent_change_7d = $cmc_data[$cmc_bitcoin_id]["percent_change_7d"];
$cmc_btc_symbol = $cmc_data[$cmc_bitcoin_id]["symbol"];

$cmc_eth_rate = $cmc_data[$cmc_ethereum_id]["price_usd"];
$cmc_eth_percent_change_1h = $cmc_data[$cmc_ethereum_id]["percent_change_1h"];
$cmc_eth_percent_change_24h = $cmc_data[$cmc_ethereum_id]["percent_change_24h"];
$cmc_eth_percent_change_7d = $cmc_data[$cmc_ethereum_id]["percent_change_7d"];
$cmc_eth_symbol = $cmc_data[$cmc_ethereum_id]["symbol"];

$cmc_ltc_rate = $cmc_data[$cmc_litecoin_id]["price_usd"];
$cmc_ltc_percent_change_1h = $cmc_data[$cmc_litecoin_id]["percent_change_1h"];
$cmc_ltc_percent_change_24h = $cmc_data[$cmc_litecoin_id]["percent_change_24h"];
$cmc_ltc_percent_change_7d = $cmc_data[$cmc_litecoin_id]["percent_change_7d"];
$cmc_ltc_symbol = $cmc_data[$cmc_litecoin_id]["symbol"];

$cmc_wpr_rate = $cmc_data[$cmc_wepower_id]["price_usd"];
$cmc_wpr_percent_change_1h = $cmc_data[$cmc_wepower_id]["percent_change_1h"];
$cmc_wpr_percent_change_24h = $cmc_data[$cmc_wepower_id]["percent_change_24h"];
$cmc_wpr_percent_change_7d = $cmc_data[$cmc_wepower_id]["percent_change_7d"];
$cmc_wpr_symbol = $cmc_data[$cmc_wepower_id]["symbol"];

// Create variables for the data to be shown in the tables for not owned coins (watchlist)

$cmc_ripple_rate = $cmc_data[$cmc_ripple_id]["price_usd"];
$cmc_ripple_percent_change_1h = $cmc_data[$cmc_ripple_id]["percent_change_1h"];
$cmc_ripple_percent_change_24h = $cmc_data[$cmc_ripple_id]["percent_change_24h"];
$cmc_ripple_percent_change_7d = $cmc_data[$cmc_ripple_id]["percent_change_7d"];
$cmc_ripple_symbol = $cmc_data[$cmc_ripple_id]["symbol"];

$cmc_cardano_rate = $cmc_data[$cmc_cardano_id]["price_usd"];
$cmc_cardano_percent_change_1h = $cmc_data[$cmc_cardano_id]["percent_change_1h"];
$cmc_cardano_percent_change_24h = $cmc_data[$cmc_cardano_id]["percent_change_24h"];
$cmc_cardano_percent_change_7d = $cmc_data[$cmc_cardano_id]["percent_change_7d"];
$cmc_cardano_symbol = $cmc_data[$cmc_cardano_id]["symbol"];

$cmc_iota_rate = $cmc_data[$cmc_iota_id]["price_usd"];
$cmc_iota_percent_change_1h = $cmc_data[$cmc_iota_id]["percent_change_1h"];
$cmc_iota_percent_change_24h = $cmc_data[$cmc_iota_id]["percent_change_24h"];
$cmc_iota_percent_change_7d = $cmc_data[$cmc_iota_id]["percent_change_7d"];
$cmc_iota_symbol = $cmc_data[$cmc_iota_id]["symbol"];

$cmc_eos_rate = $cmc_data[$cmc_eos_id]["price_usd"];
$cmc_eos_percent_change_1h = $cmc_data[$cmc_eos_id]["percent_change_1h"];
$cmc_eos_percent_change_24h = $cmc_data[$cmc_eos_id]["percent_change_24h"];
$cmc_eos_percent_change_7d = $cmc_data[$cmc_eos_id]["percent_change_7d"];
$cmc_eos_symbol = $cmc_data[$cmc_eos_id]["symbol"];

$cmc_neo_rate = $cmc_data[$cmc_neo_id]["price_usd"];
$cmc_neo_percent_change_1h = $cmc_data[$cmc_neo_id]["percent_change_1h"];
$cmc_neo_percent_change_24h = $cmc_data[$cmc_neo_id]["percent_change_24h"];
$cmc_neo_percent_change_7d = $cmc_data[$cmc_neo_id]["percent_change_7d"];
$cmc_neo_symbol = $cmc_data[$cmc_neo_id]["symbol"];

$cmc_verge_rate = $cmc_data[$cmc_verge_id]["price_usd"];
$cmc_verge_percent_change_1h = $cmc_data[$cmc_verge_id]["percent_change_1h"];
$cmc_verge_percent_change_24h = $cmc_data[$cmc_verge_id]["percent_change_24h"];
$cmc_verge_percent_change_7d = $cmc_data[$cmc_verge_id]["percent_change_7d"];
$cmc_verge_symbol = $cmc_data[$cmc_verge_id]["symbol"];

$cmc_zcash_rate = $cmc_data[$cmc_zcash_id]["price_usd"];
$cmc_zcash_percent_change_1h = $cmc_data[$cmc_zcash_id]["percent_change_1h"];
$cmc_zcash_percent_change_24h = $cmc_data[$cmc_zcash_id]["percent_change_24h"];
$cmc_zcash_percent_change_7d = $cmc_data[$cmc_zcash_id]["percent_change_7d"];
$cmc_zcash_symbol = $cmc_data[$cmc_zcash_id]["symbol"];

$cmc_waves_rate = $cmc_data[$cmc_waves_id]["price_usd"];
$cmc_waves_percent_change_1h = $cmc_data[$cmc_waves_id]["percent_change_1h"];
$cmc_waves_percent_change_24h = $cmc_data[$cmc_waves_id]["percent_change_24h"];
$cmc_waves_percent_change_7d = $cmc_data[$cmc_waves_id]["percent_change_7d"];
$cmc_waves_symbol = $cmc_data[$cmc_waves_id]["symbol"];

$cmc_burst_rate = $cmc_data[$cmc_burst_id]["price_usd"];
$cmc_burst_percent_change_1h = $cmc_data[$cmc_burst_id]["percent_change_1h"];
$cmc_burst_percent_change_24h = $cmc_data[$cmc_burst_id]["percent_change_24h"];
$cmc_burst_percent_change_7d = $cmc_data[$cmc_burst_id]["percent_change_7d"];
$cmc_burst_symbol = $cmc_data[$cmc_burst_id]["symbol"];

// Create variables for the exit amounts, exit costs and such

$paper_btc_exitamount = $paper_btc_amount - $btc_transferfee;
$paper_eth_exitamount = $paper_eth_amount - $eth_transferfee;
$paper_ltc_exitamount = $paper_ltc_amount - $ltc_transferfee;
$paper_wpr_exitamount = $paper_wpr_amount - $wpr_transferfee;

$paper_btc_exitcost = (0.0025 * ($paper_btc_exitamount * $cmc_btc_rate)) + (0.9 * $exchange_EUR_USD );
$paper_eth_exitcost = (0.0025 * ($paper_eth_exitamount * $cmc_eth_rate)) + (0.9 * $exchange_EUR_USD );
$paper_ltc_exitcost = (0.0025 * ($paper_ltc_exitamount * $cmc_ltc_rate)) + (0.9 * $exchange_EUR_USD );
$paper_wpr_exitcost = (0.0025 * ($paper_wpr_exitamount * $cmc_wpr_rate)) + (0.9 * $exchange_EUR_USD );

$paper_btc_totalexit = ($paper_btc_exitamount * $cmc_btc_rate) - $paper_btc_exitcost;
$paper_eth_totalexit = ($paper_eth_exitamount * $cmc_eth_rate) - $paper_eth_exitcost;
$paper_ltc_totalexit = ($paper_ltc_exitamount * $cmc_ltc_rate) - $paper_ltc_exitcost;
$paper_wpr_totalexit = ($paper_wpr_exitamount * $cmc_wpr_rate) - $paper_wpr_exitcost;

// Create variables for the profit with and without deducting exit costs. Both in fiat and percentage-based

$paper_btc_profit = ($cmc_btc_rate - $paper_btc_buyinrate ) * $paper_btc_amount;
$paper_eth_profit = ($cmc_eth_rate - $paper_eth_buyinrate ) * $paper_eth_amount;
$paper_ltc_profit = ($cmc_ltc_rate - $paper_ltc_buyinrate ) * $paper_ltc_amount;
$paper_wpr_profit = ($cmc_wpr_rate - $paper_wpr_buyinrate ) * $paper_wpr_amount;

$paper_btc_percent_profit = ($paper_btc_profit / $paper_btc_totalbuyin) * 100;
$paper_eth_percent_profit = ($paper_eth_profit / $paper_eth_totalbuyin) * 100;
$paper_ltc_percent_profit = ($paper_ltc_profit / $paper_ltc_totalbuyin) * 100;
$paper_wpr_percent_profit = ($paper_wpr_profit / $paper_wpr_totalbuyin) * 100;

$paper_btc_exitprofit = $paper_btc_totalexit - $paper_btc_totalbuyin;
$paper_eth_exitprofit = $paper_eth_totalexit - $paper_eth_totalbuyin;
$paper_ltc_exitprofit = $paper_ltc_totalexit - $paper_ltc_totalbuyin;
$paper_wpr_exitprofit = $paper_wpr_totalexit - $paper_wpr_totalbuyin;

$paper_btc_percent_exitprofit = ($paper_btc_exitprofit / $paper_btc_totalbuyin) * 100;
$paper_eth_percent_exitprofit = ($paper_eth_exitprofit / $paper_eth_totalbuyin) * 100;
$paper_ltc_percent_exitprofit = ($paper_ltc_exitprofit / $paper_ltc_totalbuyin) * 100;
$paper_wpr_percent_exitprofit = ($paper_wpr_exitprofit / $paper_wpr_totalbuyin) * 100;

$paper_total_profit = $paper_btc_profit + $paper_eth_profit + $paper_ltc_profit + $paper_wpr_profit;
$paper_total_percent_profit = ($paper_total_profit / ($paper_btc_totalbuyin + $paper_eth_totalbuyin + $paper_ltc_totalbuyin + $paper_wpr_totalbuyin)) * 100;
$paper_total_exitprofit = $paper_btc_exitprofit + $paper_eth_exitprofit + $paper_ltc_exitprofit + $paper_wpr_exitprofit;
$paper_total_percent_exitprofit = ($paper_total_exitprofit / ($paper_btc_totalbuyin + $paper_eth_totalbuyin + $paper_ltc_totalbuyin +$paper_wpr_totalbuyin)) * 100;

// Perform calculations to convert everything to euro's for the second table in euro's

$cmc_btc_rate_eu = $cmc_btc_rate / $exchange_EUR_USD;
$cmc_eth_rate_eu = $cmc_eth_rate / $exchange_EUR_USD;
$cmc_ltc_rate_eu = $cmc_ltc_rate / $exchange_EUR_USD;
$cmc_wpr_rate_eu = $cmc_wpr_rate / $exchange_EUR_USD;

$paper_btc_buyinrate_eu = $paper_btc_buyinrate / $exchange_EUR_USD;
$paper_eth_buyinrate_eu = $paper_eth_buyinrate / $exchange_EUR_USD;
$paper_ltc_buyinrate_eu = $paper_ltc_buyinrate / $exchange_EUR_USD;
$paper_wpr_buyinrate_eu = $paper_wpr_buyinrate / $exchange_EUR_USD;

$paper_btc_profit_eu = $paper_btc_profit / $exchange_EUR_USD;
$paper_eth_profit_eu = $paper_eth_profit / $exchange_EUR_USD;
$paper_ltc_profit_eu = $paper_ltc_profit / $exchange_EUR_USD;
$paper_wpr_profit_eu = $paper_wpr_profit / $exchange_EUR_USD;

$paper_btc_exitprofit_eu = $paper_btc_exitprofit / $exchange_EUR_USD;
$paper_eth_exitprofit_eu = $paper_eth_exitprofit / $exchange_EUR_USD;
$paper_ltc_exitprofit_eu = $paper_ltc_exitprofit / $exchange_EUR_USD;
$paper_wpr_exitprofit_eu = $paper_wpr_exitprofit / $exchange_EUR_USD;

$paper_total_profit_eu = $paper_total_profit / $exchange_EUR_USD;
$paper_total_exitprofit_eu = $paper_total_exitprofit / $exchange_EUR_USD;

?>