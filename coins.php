<?php 
session_start();

// Check session

if(!isset($_SESSION['UserData']['Username'])){
	header("location:index.php");
	exit;
}
?>


<html>
<head>
<title>Testing</title>
<link rel="stylesheet" type="text/css" href="coinstyle.css" />
<script src="tabs.js"></script>
</head>
<body>

<div class="tab">
  <button class="tablinks" onclick="openTabcontent(event, 'Coins')">Coins</button>
  <button class="tablinks" onclick="openTabcontent(event, 'Watchlist')">Watchlist</button>
</div>

<div id="Coins" class="tabcontent" align="center">

<!-- Content of the first tab goes here. Needs cleaning into separate files. -->

<?php

// This is a single api call per page load that brings up the data for the top 10 coins from coinmarketcap

$url = "https://api.coinmarketcap.com/v1/ticker/?limit=1000";
$json = file_get_contents($url);
$data = json_decode($json, TRUE);

// Make an easy usable array containing only the coin names and id (index key) for further use

$list_coin_names = array_column($data, 'name');

// Get proper id (index key) for interesting coins from the array to use when assigning variables to info from the array

$bitcoin_id = array_search('Bitcoin', $list_coin_names);
$ethereum_id = array_search('Ethereum', $list_coin_names);
$ripple_id = array_search('Ripple', $list_coin_names);
$litecoin_id = array_search('Litecoin', $list_coin_names);
$cardano_id = array_search('Cardano', $list_coin_names);
$iota_id = array_search('IOTA', $list_coin_names);
$eos_id = array_search('EOS', $list_coin_names);
$neo_id = array_search('NEO', $list_coin_names);
$verge_id = array_search('Verge', $list_coin_names);
$zcash_id = array_search('Zcash', $list_coin_names);
$waves_id = array_search('Waves', $list_coin_names);
$burst_id = array_search('Burst', $list_coin_names);

// Create variables for the data to be shown in the tables for owned coins

$btc_rate = $data[$bitcoin_id]["price_usd"];
$btc_percent_change_1h = $data[$bitcoin_id]["percent_change_1h"];
$btc_percent_change_24h = $data[$bitcoin_id]["percent_change_24h"];
$btc_percent_change_7d = $data[$bitcoin_id]["percent_change_7d"];
$btc_symbol = $data[$bitcoin_id]["symbol"];

$eth_rate = $data[$ethereum_id]["price_usd"];
$eth_percent_change_1h = $data[$ethereum_id]["percent_change_1h"];
$eth_percent_change_24h = $data[$ethereum_id]["percent_change_24h"];
$eth_percent_change_7d = $data[$ethereum_id]["percent_change_7d"];
$eth_symbol = $data[$ethereum_id]["symbol"];

$ltc_rate = $data[$litecoin_id]["price_usd"];
$ltc_percent_change_1h = $data[$litecoin_id]["percent_change_1h"];
$ltc_percent_change_24h = $data[$litecoin_id]["percent_change_24h"];
$ltc_percent_change_7d = $data[$litecoin_id]["percent_change_7d"];
$ltc_symbol = $data[$litecoin_id]["symbol"];

// Create variables for the data to be shown in the tables for not owned coins (watchlist)

$ripple_rate = $data[$ripple_id]["price_usd"];
$ripple_percent_change_1h = $data[$ripple_id]["percent_change_1h"];
$ripple_percent_change_24h = $data[$ripple_id]["percent_change_24h"];
$ripple_percent_change_7d = $data[$ripple_id]["percent_change_7d"];
$ripple_symbol = $data[$ripple_id]["symbol"];

$cardano_rate = $data[$cardano_id]["price_usd"];
$cardano_percent_change_1h = $data[$cardano_id]["percent_change_1h"];
$cardano_percent_change_24h = $data[$cardano_id]["percent_change_24h"];
$cardano_percent_change_7d = $data[$cardano_id]["percent_change_7d"];
$cardano_symbol = $data[$cardano_id]["symbol"];

$iota_rate = $data[$iota_id]["price_usd"];
$iota_percent_change_1h = $data[$iota_id]["percent_change_1h"];
$iota_percent_change_24h = $data[$iota_id]["percent_change_24h"];
$iota_percent_change_7d = $data[$iota_id]["percent_change_7d"];
$iota_symbol = $data[$iota_id]["symbol"];

$eos_rate = $data[$eos_id]["price_usd"];
$eos_percent_change_1h = $data[$eos_id]["percent_change_1h"];
$eos_percent_change_24h = $data[$eos_id]["percent_change_24h"];
$eos_percent_change_7d = $data[$eos_id]["percent_change_7d"];
$eos_symbol = $data[$eos_id]["symbol"];

$neo_rate = $data[$neo_id]["price_usd"];
$neo_percent_change_1h = $data[$neo_id]["percent_change_1h"];
$neo_percent_change_24h = $data[$neo_id]["percent_change_24h"];
$neo_percent_change_7d = $data[$neo_id]["percent_change_7d"];
$neo_symbol = $data[$neo_id]["symbol"];

$verge_rate = $data[$verge_id]["price_usd"];
$verge_percent_change_1h = $data[$verge_id]["percent_change_1h"];
$verge_percent_change_24h = $data[$verge_id]["percent_change_24h"];
$verge_percent_change_7d = $data[$verge_id]["percent_change_7d"];
$verge_symbol = $data[$verge_id]["symbol"];

$zcash_rate = $data[$zcash_id]["price_usd"];
$zcash_percent_change_1h = $data[$zcash_id]["percent_change_1h"];
$zcash_percent_change_24h = $data[$zcash_id]["percent_change_24h"];
$zcash_percent_change_7d = $data[$zcash_id]["percent_change_7d"];
$zcash_symbol = $data[$zcash_id]["symbol"];

$waves_rate = $data[$waves_id]["price_usd"];
$waves_percent_change_1h = $data[$waves_id]["percent_change_1h"];
$waves_percent_change_24h = $data[$waves_id]["percent_change_24h"];
$waves_percent_change_7d = $data[$waves_id]["percent_change_7d"];
$waves_symbol = $data[$waves_id]["symbol"];

$burst_rate = $data[$burst_id]["price_usd"];
$burst_percent_change_1h = $data[$burst_id]["percent_change_1h"];
$burst_percent_change_24h = $data[$burst_id]["percent_change_24h"];
$burst_percent_change_7d = $data[$burst_id]["percent_change_7d"];
$burst_symbol = $data[$burst_id]["symbol"];

// This is a single api call per page load that brings up latest exchange data between EUR and USD, using EUR as base

$url = "https://api.fixer.io/latest?symbols=USD";
$json = file_get_contents($url);
$exchangedata_EUR_USD = json_decode($json, TRUE);
$exchange_EUR_USD = $exchangedata_EUR_USD["rates"]["USD"];

// Assign static variables for calculations. Quick and dirty cause no database or any wallet access. ALL IN DOLLARS. All from the file input.php

include 'input.php';

// Fetch the current LTC balance from the LTC public key entered. Uses the chainz.cryptoid.info api. 1 API call currently per pageload.

$url = "https://chainz.cryptoid.info/ltc/api.dws?q=getbalance&a=$ltc_publickey";
$json = file_get_contents($url);
$ltc_amount = json_decode($json, TRUE);

// Perform calculations here instead of in the divs, specific for exit_amounts
// Start calculations for owned coins

$btc_exitamount = $btc_amount - $btc_transferfee;
$eth_exitamount = $eth_amount - $eth_transferfee;
$ltc_exitamount = $ltc_amount - $ltc_transferfee;

$btc_exitcost = (0.0025 * ($btc_exitamount * $btc_rate)) + (0.9 * $exchange_EUR_USD );
$eth_exitcost = (0.0025 * ($eth_exitamount * $eth_rate)) + (0.9 * $exchange_EUR_USD );
$ltc_exitcost = (0.0025 * ($ltc_exitamount * $ltc_rate)) + (0.9 * $exchange_EUR_USD );

$btc_totalexit = ($btc_exitamount * $btc_rate) - $btc_exitcost;
$eth_totalexit = ($eth_exitamount * $eth_rate) - $eth_exitcost;
$ltc_totalexit = ($ltc_exitamount * $ltc_rate) - $ltc_exitcost;

$btc_profit = ($btc_rate - $btc_buyinrate ) * $btc_amount;
$eth_profit = ($eth_rate - $eth_buyinrate ) * $eth_amount;
$ltc_profit = ($ltc_rate - $ltc_buyinrate ) * $ltc_amount;

$btc_percent_profit = ($btc_profit / $btc_totalbuyin) * 100;
$eth_percent_profit = ($eth_profit / $eth_totalbuyin) * 100;
$ltc_percent_profit = ($ltc_profit / $ltc_totalbuyin) * 100;

$btc_exitprofit = $btc_totalexit - $btc_totalbuyin;
$eth_exitprofit = $eth_totalexit - $eth_totalbuyin;
$ltc_exitprofit = $ltc_totalexit - $ltc_totalbuyin;

$btc_percent_exitprofit = ($btc_exitprofit / $btc_totalbuyin) * 100;
$eth_percent_exitprofit = ($eth_exitprofit / $eth_totalbuyin) * 100;
$ltc_percent_exitprofit = ($ltc_exitprofit / $ltc_totalbuyin) * 100;

$total_profit = $btc_profit + $eth_profit + $ltc_profit;
$total_percent_profit = ($total_profit / ($btc_totalbuyin + $eth_totalbuyin + $ltc_totalbuyin)) * 100;
$total_exitprofit = $btc_exitprofit + $eth_exitprofit + $ltc_exitprofit;
$total_percent_exitprofit = ($total_exitprofit / ($btc_totalbuyin + $eth_totalbuyin + $ltc_totalbuyin)) * 100;

// Start calculations for not owned coins / simulated profits

// Calculate simulated bought amount for 100 euros

$burst_amount = 100 / $burst_buyintarget;
$cardano_amount = 100 / $cardano_buyintarget;
$eos_amount = 100 / $eos_buyintarget;
$iota_amount = 100 / $iota_buyintarget;
$neo_amount = 100 / $neo_buyintarget;
$ripple_amount = 100 / $ripple_buyintarget;
$verge_amount = 100 / $verge_buyintarget;
$waves_amount = 100 / $waves_buyintarget;
$zcash_amount = 100 / $zcash_buyintarget;

$burst_exitamount = $burst_amount - $burst_transferfee;
$cardano_exitamount = $cardano_amount - $cardano_transferfee;
$eos_exitamount = $eos_amount - $eos_transferfee;
$iota_exitamount = $iota_amount - $iota_transferfee;
$neo_exitamount = $neo_amount - $neo_transferfee;
$ripple_exitamount = $ripple_amount - $ripple_transferfee;
$verge_exitamount = $verge_amount - $verge_transferfee;
$waves_exitamount = $waves_amount - $waves_transferfee;
$zcash_exitamount = $zcash_amount - $zcash_transferfee;

$burst_exitcost = (0.0025 * ($burst_exitamount * $burst_rate)) + (0.9 * $exchange_EUR_USD );
$cardano_exitcost = (0.0025 * ($cardano_exitamount * $cardano_rate)) + (0.9 * $exchange_EUR_USD );
$eos_exitcost = (0.0025 * ($eos_exitamount * $eos_rate)) + (0.9 * $exchange_EUR_USD );
$iota_exitcost = (0.0025 * ($iota_exitamount * $iota_rate)) + (0.9 * $exchange_EUR_USD );
$neo_exitcost = (0.0025 * ($neo_exitamount * $neo_rate)) + (0.9 * $exchange_EUR_USD );
$ripple_exitcost = (0.0025 * ($ripple_exitamount * $ripple_rate)) + (0.9 * $exchange_EUR_USD );
$verge_exitcost = (0.0025 * ($verge_exitamount * $verge_rate)) + (0.9 * $exchange_EUR_USD );
$waves_exitcost = (0.0025 * ($waves_exitamount * $waves_rate)) + (0.9 * $exchange_EUR_USD );
$zcash_exitcost = (0.0025 * ($zcash_exitamount * $zcash_rate)) + (0.9 * $exchange_EUR_USD );

$burst_totalexit = ($burst_exitamount * $burst_rate) - $burst_exitcost;
$cardano_totalexit = ($cardano_exitamount * $cardano_rate) - $cardano_exitcost;
$eos_totalexit = ($eos_exitamount * $eos_rate) - $eos_exitcost;
$iota_totalexit = ($iota_exitamount * $iota_rate) - $iota_exitcost;
$neo_totalexit = ($neo_exitamount * $neo_rate) - $neo_exitcost;
$ripple_totalexit = ($ripple_exitamount * $ripple_rate) - $ripple_exitcost;
$verge_totalexit = ($verge_exitamount * $verge_rate) - $verge_exitcost;
$waves_totalexit = ($waves_exitamount * $waves_rate) - $waves_exitcost;
$zcash_totalexit = ($zcash_exitamount * $zcash_rate) - $zcash_exitcost;

$burst_exitprofit = $burst_totalexit - (100 * $exchange_EUR_USD );
$cardano_exitprofit = $cardano_totalexit - (100 * $exchange_EUR_USD );
$eos_exitprofit = $eos_totalexit - (100 * $exchange_EUR_USD );
$iota_exitprofit = $iota_totalexit - (100 * $exchange_EUR_USD );
$neo_exitprofit = $neo_totalexit - (100 * $exchange_EUR_USD );
$ripple_exitprofit = $ripple_totalexit - (100 * $exchange_EUR_USD );
$verge_exitprofit = $verge_totalexit - (100 * $exchange_EUR_USD );
$waves_exitprofit = $waves_totalexit - (100 * $exchange_EUR_USD );
$zcash_exitprofit = $zcash_totalexit - (100 * $exchange_EUR_USD );

$burst_percent_exitprofit = ($burst_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$cardano_percent_exitprofit = ($cardano_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$eos_percent_exitprofit = ($eos_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$iota_percent_exitprofit = ($iota_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$neo_percent_exitprofit = ($neo_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$ripple_percent_exitprofit = ($ripple_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$verge_percent_exitprofit = ($verge_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$waves_percent_exitprofit = ($waves_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;
$zcash_percent_exitprofit = ($zcash_exitprofit / (100 * $exchange_EUR_USD ) ) * 100;

// Perform calculations to convert everything to euro's for the second table of owned coins

$btc_rate_eu = $btc_rate / $exchange_EUR_USD;
$eth_rate_eu = $eth_rate / $exchange_EUR_USD;
$ltc_rate_eu = $ltc_rate / $exchange_EUR_USD;

$btc_buyinrate_eu = $btc_buyinrate / $exchange_EUR_USD;
$eth_buyinrate_eu = $eth_buyinrate / $exchange_EUR_USD;
$ltc_buyinrate_eu = $ltc_buyinrate / $exchange_EUR_USD;

$btc_profit_eu = $btc_profit / $exchange_EUR_USD;
$eth_profit_eu = $eth_profit / $exchange_EUR_USD;
$ltc_profit_eu = $ltc_profit / $exchange_EUR_USD;

$btc_exitprofit_eu = $btc_exitprofit / $exchange_EUR_USD;
$eth_exitprofit_eu = $eth_exitprofit / $exchange_EUR_USD;
$ltc_exitprofit_eu = $ltc_exitprofit / $exchange_EUR_USD;

$total_profit_eu = $total_profit / $exchange_EUR_USD;
$total_exitprofit_eu = $total_exitprofit / $exchange_EUR_USD;

?>

<!-- First table for USD prices of coinmarketcap -->

<div class="wrapper">

<div class="table">
  <div class="row header blue" style="display:table-row">
    <div class="cell">Coinmarketcap (in dollars)</div>
  </div>
</div>
<div class="table">
<div class="row header green">
      <div class="cell">
        Coin
      </div>
      <div class="cell">
        Symbol
      </div>
      <div class="cell">
        Value
      </div>
      <div class="cell">
        Buyin Value
      </div>
      <div class="cell">
        Change 1&nbsp;hour
      </div>
      <div class="cell">
        Change 24&nbsp;hours
      </div>
      <div class="cell">
        Change 7&nbsp;days
      </div>
      <div class="cell">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell">
        Profit
      </div>
      <div class="cell">
        Profit&nbsp;%
      </div>
      <div class="cell">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell">
        Profit minus&nbsp;fees
      </div>
      <div class="cell">
        Profit % minus&nbsp;fees
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Bitcoin
      </div>
      <div class="cell" data-title="Symbol">
        <?=$btc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$btc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$btc_buyinrate?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$btc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$btc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$btc_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($btc_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($btc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($btc_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($btc_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Ethereum
      </div>
      <div class="cell" data-title="Symbol">
        <?=$eth_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$eth_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$eth_buyinrate?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$eth_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$eth_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$eth_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($eth_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
       <?=round($eth_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($eth_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($eth_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Litecoin
      </div>
      <div class="cell" data-title="Symbol">
        <?=$ltc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$ltc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$ltc_buyinrate?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$ltc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$ltc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$ltc_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($ltc_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($ltc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($ltc_exitprofit, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($ltc_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        &nbsp;
      </div>
      <div class="cell" data-title="Symbol">
        &nbsp;
      </div>
      <div class="cell" data-title="Value">
        &nbsp;
      </div>
      <div class="cell" data-title="buyin_rate">
        &nbsp;
      </div>
      <div class="cell" data-title="percent_change_1h">
        &nbsp;
      </div>
      <div class="cell" data-title="percent_change_24h">
        &nbsp;
      </div>
      <div class="cell" data-title="percent_change_7d">
        &nbsp;
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($total_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($total_exitprofit, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($total_percent_exitprofit, 2)?>%
      </div>

</div>

</div>

</div>

<!-- Second table for EUR prices of coinmarketcap -->

<div class="wrapper">

<div class="table">
  <div class="row header blue" style="display:table-row">
    <div class="cell">Coinmarketcap (in euro's)</div>
  </div>
</div>
<div class="table">
<div class="row header green">
      <div class="cell">
        Coin
      </div>
      <div class="cell">
        Symbol
      </div>
      <div class="cell">
        Value
      </div>
      <div class="cell">
        Buyin Value
      </div>
      <div class="cell">
        Change 1&nbsp;hour
      </div>
      <div class="cell">
        Change 24&nbsp;hours
      </div>
      <div class="cell">
        Change 7&nbsp;days
      </div>
      <div class="cell">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell">
        Profit
      </div>
      <div class="cell">
        Profit&nbsp;%
      </div>
      <div class="cell">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell">
        Profit minus&nbsp;fees
      </div>
      <div class="cell">
        Profit&nbsp;% minus&nbsp;fees
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Bitcoin
      </div>
      <div class="cell" data-title="Symbol">
        <?=$btc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      €&nbsp;<?=round($btc_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($btc_buyinrate_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$btc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$btc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$btc_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      €&nbsp;<?=round($btc_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($btc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($btc_exitprofit_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($btc_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Ethereum
      </div>
      <div class="cell" data-title="Symbol">
        <?=$eth_symbol?>
      </div>
      <div class="cell" data-title="Value">
      €&nbsp;<?=round($eth_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($eth_buyinrate_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$eth_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$eth_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$eth_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      €&nbsp;<?=round($eth_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
       <?=round($eth_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($eth_exitprofit_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($eth_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Litecoin
      </div>
      <div class="cell" data-title="Symbol">
        <?=$ltc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      €&nbsp;<?=round($ltc_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($ltc_buyinrate_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$ltc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$ltc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$ltc_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      €&nbsp;<?=round($ltc_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($ltc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($ltc_exitprofit_eu, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($ltc_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        &nbsp;
      </div>
      <div class="cell" data-title="Symbol">
        &nbsp;
      </div>
      <div class="cell" data-title="Value">
        &nbsp;
      </div>
      <div class="cell" data-title="buyin_rate">
        &nbsp;
      </div>
      <div class="cell" data-title="percent_change_1h">
        &nbsp;
      </div>
      <div class="cell" data-title="percent_change_24h">
        &nbsp;
      </div>
      <div class="cell" data-title="percent_change_7d">
        &nbsp;
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit">
      €&nbsp;<?=round($total_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($total_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($total_exitprofit_eu, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($total_percent_exitprofit, 2)?>%
      </div>

</div>
</div>
</div>

</div>

<!-- End of content of the first tab. -->

<div id="Watchlist" class="tabcontent" align="center">

<!-- Content of the second tab goes here. Needs cleaning into separate files. -->

<!-- First table for USD prices of coinmarketcap -->

<div class="wrapper">

<div class="table">
  <div class="row header blue" style="display:table-row">
    <div class="cell">Coinmarketcap (in dollars)</div>
  </div>
</div>
<div class="table">
<div class="row header green">
      <div class="cell">
        Coin
      </div>
      <div class="cell">
        Symbol
      </div>
      <div class="cell">
        Value
      </div>
      <div class="cell">
        Buyin Target
      </div>
      <div class="cell">
        Change 1&nbsp;hour
      </div>
      <div class="cell">
        Change 24&nbsp;hours
      </div>
      <div class="cell">
        Change 7&nbsp;days
      </div>
      <div class="cell">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell">
        Simulated&nbsp;Profit per&nbsp;€&nbsp;100 minus&nbsp;fees
      </div>
      <div class="cell">
        Simulated&nbsp;Profit per&nbsp;€&nbsp;100 minus&nbsp;fees&nbsp;%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Burst
      </div>
      <div class="cell" data-title="Symbol">
        <?=$burst_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$burst_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$burst_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$burst_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$burst_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$burst_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($burst_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
       <?=round($burst_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Cardano (ADA)
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cardano_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cardano_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$cardano_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cardano_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cardano_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cardano_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($cardano_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($cardano_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Eos
      </div>
      <div class="cell" data-title="Symbol">
        <?=$eos_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$eos_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$eos_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$eos_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$eos_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$eos_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($eos_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($eos_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Iota
      </div>
      <div class="cell" data-title="Symbol">
        <?=$iota_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$iota_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$iota_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$iota_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$iota_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$iota_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($iota_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($iota_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Neo
      </div>
      <div class="cell" data-title="Symbol">
        <?=$neo_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$neo_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$neo_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$neo_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$neo_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$neo_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($neo_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($neo_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Ripple (XRP)
      </div>
      <div class="cell" data-title="Symbol">
        <?=$ripple_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$ripple_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$ripple_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$ripple_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$ripple_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$ripple_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($ripple_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($ripple_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Verge (XVG)
      </div>
      <div class="cell" data-title="Symbol">
        <?=$verge_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$verge_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$verge_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$verge_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$verge_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$verge_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($verge_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($verge_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Waves
      </div>
      <div class="cell" data-title="Symbol">
        <?=$waves_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$waves_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$waves_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$waves_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$waves_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$waves_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($waves_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($waves_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Zcash (ZEC)
      </div>
      <div class="cell" data-title="Symbol">
        <?=$zcash_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$zcash_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$zcash_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$zcash_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$zcash_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$zcash_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($zcash_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($zcash_percent_exitprofit, 2)?>%
      </div>
</div>

</div>

</div>

</div>

<!-- End of content of the second tab -->

<!-- Log out option below here -->

<div class="logout table" style="border: 1px" align="center">
  <div class="row header green"  align="center">
    <div class="cell" align="center"><a href="logout.php">Click here</a> to Logout.</div>
  </div>
</div>

</div>

</body>
</html>
