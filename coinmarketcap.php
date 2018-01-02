<?php

// coinmarketcap will be refered to as cmc for variables

// This is a single api call per page load that brings up the data for the top 10 coins from coinmarketcap

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

// Create variables for the data to be shown in the tables for owned coins

$cmc_btc_rate = $coinmarketcap_data[$cmc_bitcoin_id]["price_usd"];
$cmc_btc_percent_change_1h = $coinmarketcap_data[$cmc_bitcoin_id]["percent_change_1h"];
$cmc_btc_percent_change_24h = $coinmarketcap_data[$cmc_bitcoin_id]["percent_change_24h"];
$cmc_btc_percent_change_7d = $coinmarketcap_data[$cmc_bitcoin_id]["percent_change_7d"];
$cmc_btc_symbol = $coinmarketcap_data[$cmc_bitcoin_id]["symbol"];

$cmc_eth_rate = $coinmarketcap_data[$cmc_ethereum_id]["price_usd"];
$cmc_eth_percent_change_1h = $coinmarketcap_data[$cmc_ethereum_id]["percent_change_1h"];
$cmc_eth_percent_change_24h = $coinmarketcap_data[$cmc_ethereum_id]["percent_change_24h"];
$cmc_eth_percent_change_7d = $coinmarketcap_data[$cmc_ethereum_id]["percent_change_7d"];
$cmc_eth_symbol = $coinmarketcap_data[$cmc_ethereum_id]["symbol"];

$cmc_ltc_rate = $coinmarketcap_data[$cmc_litecoin_id]["price_usd"];
$cmc_ltc_percent_change_1h = $coinmarketcap_data[$cmc_litecoin_id]["percent_change_1h"];
$cmc_ltc_percent_change_24h = $coinmarketcap_data[$cmc_litecoin_id]["percent_change_24h"];
$cmc_ltc_percent_change_7d = $coinmarketcap_data[$cmc_litecoin_id]["percent_change_7d"];
$cmc_ltc_symbol = $coinmarketcap_data[$cmc_litecoin_id]["symbol"];

// Create variables for the data to be shown in the tables for not owned coins (watchlist)

$cmc_ripple_rate = $coinmarketcap_data[$cmc_ripple_id]["price_usd"];
$cmc_ripple_percent_change_1h = $coinmarketcap_data[$cmc_ripple_id]["percent_change_1h"];
$cmc_ripple_percent_change_24h = $coinmarketcap_data[$cmc_ripple_id]["percent_change_24h"];
$cmc_ripple_percent_change_7d = $coinmarketcap_data[$cmc_ripple_id]["percent_change_7d"];
$cmc_ripple_symbol = $coinmarketcap_data[$cmc_ripple_id]["symbol"];

$cmc_cardano_rate = $coinmarketcap_data[$cmc_cardano_id]["price_usd"];
$cmc_cardano_percent_change_1h = $coinmarketcap_data[$cmc_cardano_id]["percent_change_1h"];
$cmc_cardano_percent_change_24h = $coinmarketcap_data[$cmc_cardano_id]["percent_change_24h"];
$cmc_cardano_percent_change_7d = $coinmarketcap_data[$cmc_cardano_id]["percent_change_7d"];
$cmc_cardano_symbol = $coinmarketcap_data[$cmc_cardano_id]["symbol"];

$cmc_iota_rate = $coinmarketcap_data[$cmc_iota_id]["price_usd"];
$cmc_iota_percent_change_1h = $coinmarketcap_data[$cmc_iota_id]["percent_change_1h"];
$cmc_iota_percent_change_24h = $coinmarketcap_data[$cmc_iota_id]["percent_change_24h"];
$cmc_iota_percent_change_7d = $coinmarketcap_data[$cmc_iota_id]["percent_change_7d"];
$cmc_iota_symbol = $coinmarketcap_data[$cmc_iota_id]["symbol"];

$cmc_eos_rate = $coinmarketcap_data[$cmc_eos_id]["price_usd"];
$cmc_eos_percent_change_1h = $coinmarketcap_data[$cmc_eos_id]["percent_change_1h"];
$cmc_eos_percent_change_24h = $coinmarketcap_data[$cmc_eos_id]["percent_change_24h"];
$cmc_eos_percent_change_7d = $coinmarketcap_data[$cmc_eos_id]["percent_change_7d"];
$cmc_eos_symbol = $coinmarketcap_data[$cmc_eos_id]["symbol"];

$cmc_neo_rate = $coinmarketcap_data[$cmc_neo_id]["price_usd"];
$cmc_neo_percent_change_1h = $coinmarketcap_data[$cmc_neo_id]["percent_change_1h"];
$cmc_neo_percent_change_24h = $coinmarketcap_data[$cmc_neo_id]["percent_change_24h"];
$cmc_neo_percent_change_7d = $coinmarketcap_data[$cmc_neo_id]["percent_change_7d"];
$cmc_neo_symbol = $coinmarketcap_data[$cmc_neo_id]["symbol"];

$cmc_verge_rate = $coinmarketcap_data[$cmc_verge_id]["price_usd"];
$cmc_verge_percent_change_1h = $coinmarketcap_data[$cmc_verge_id]["percent_change_1h"];
$cmc_verge_percent_change_24h = $coinmarketcap_data[$cmc_verge_id]["percent_change_24h"];
$cmc_verge_percent_change_7d = $coinmarketcap_data[$cmc_verge_id]["percent_change_7d"];
$cmc_verge_symbol = $coinmarketcap_data[$cmc_verge_id]["symbol"];

$cmc_zcash_rate = $coinmarketcap_data[$cmc_zcash_id]["price_usd"];
$cmc_zcash_percent_change_1h = $coinmarketcap_data[$cmc_zcash_id]["percent_change_1h"];
$cmc_zcash_percent_change_24h = $coinmarketcap_data[$cmc_zcash_id]["percent_change_24h"];
$cmc_zcash_percent_change_7d = $coinmarketcap_data[$cmc_zcash_id]["percent_change_7d"];
$cmc_zcash_symbol = $coinmarketcap_data[$cmc_zcash_id]["symbol"];

$cmc_waves_rate = $coinmarketcap_data[$cmc_waves_id]["price_usd"];
$cmc_waves_percent_change_1h = $coinmarketcap_data[$cmc_waves_id]["percent_change_1h"];
$cmc_waves_percent_change_24h = $coinmarketcap_data[$cmc_waves_id]["percent_change_24h"];
$cmc_waves_percent_change_7d = $coinmarketcap_data[$cmc_waves_id]["percent_change_7d"];
$cmc_waves_symbol = $coinmarketcap_data[$cmc_waves_id]["symbol"];

$cmc_burst_rate = $coinmarketcap_data[$cmc_burst_id]["price_usd"];
$cmc_burst_percent_change_1h = $coinmarketcap_data[$cmc_burst_id]["percent_change_1h"];
$cmc_burst_percent_change_24h = $coinmarketcap_data[$cmc_burst_id]["percent_change_24h"];
$cmc_burst_percent_change_7d = $coinmarketcap_data[$cmc_burst_id]["percent_change_7d"];
$cmc_burst_symbol = $coinmarketcap_data[$cmc_burst_id]["symbol"];

?>