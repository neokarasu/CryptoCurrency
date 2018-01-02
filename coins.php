<?php 
session_start();

// Check session

if(!isset($_SESSION['UserData']['Username'])){
	header("location:index.php");
	exit;
}

// API calls and calculations for coinmarketcap tabs in coinmarketcap.php

require 'coinmarketcap.php';

// API calls and everything for eur-usd fiat exchange in fiatexchange.php

require 'fiatexchange.php';

// All static variables and everything that needs to be manually input in input.php

require 'input.php';

// All the balance information is in balance.php

require 'balance.php';

// All the watchlist information is in watchlist.php 

require 'watchlist.php';
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

<?php

// Perform calculations here instead of in the divs, specific for exit_amounts
// Start calculations for owned coins

// For future use, plan is to divide calculation of fees between paper wallets and exchange wallets
// $paper_btc_exitamount = $btc_amount - $btc_transferfee;
// $paper_eth_exitamount = $eth_amount - $eth_transferfee;
// $paper_ltc_exitamount = $ltc_amount - $ltc_transferfee;

$btc_exitamount = $btc_amount - $btc_transferfee;
$eth_exitamount = $eth_amount - $eth_transferfee;
$ltc_exitamount = $ltc_amount - $ltc_transferfee;

$btc_exitcost = (0.0025 * ($btc_exitamount * $cmc_btc_rate)) + (0.9 * $exchange_EUR_USD );
$eth_exitcost = (0.0025 * ($eth_exitamount * $cmc_eth_rate)) + (0.9 * $exchange_EUR_USD );
$ltc_exitcost = (0.0025 * ($ltc_exitamount * $cmc_ltc_rate)) + (0.9 * $exchange_EUR_USD );

$btc_totalexit = ($btc_exitamount * $cmc_btc_rate) - $btc_exitcost;
$eth_totalexit = ($eth_exitamount * $cmc_eth_rate) - $eth_exitcost;
$ltc_totalexit = ($ltc_exitamount * $cmc_ltc_rate) - $ltc_exitcost;

$btc_profit = ($cmc_btc_rate - $btc_buyinrate ) * $btc_amount;
$eth_profit = ($cmc_eth_rate - $eth_buyinrate ) * $eth_amount;
$ltc_profit = ($cmc_ltc_rate - $ltc_buyinrate ) * $ltc_amount;

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

// Perform calculations to convert everything to euro's for the second table of owned coins

$cmc_btc_rate_eu = $cmc_btc_rate / $exchange_EUR_USD;
$cmc_eth_rate_eu = $cmc_eth_rate / $exchange_EUR_USD;
$cmc_ltc_rate_eu = $cmc_ltc_rate / $exchange_EUR_USD;

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
        <?=$cmc_btc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_btc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$btc_buyinrate?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_btc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_btc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_btc_percent_change_7d?>%
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
        <?=$cmc_eth_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_eth_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$eth_buyinrate?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_eth_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_eth_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_eth_percent_change_7d?>%
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
        <?=$cmc_ltc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_ltc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$ltc_buyinrate?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_ltc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_ltc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_ltc_percent_change_7d?>%
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
        <?=$cmc_btc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      €&nbsp;<?=round($cmc_btc_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($btc_buyinrate_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_btc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_btc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_btc_percent_change_7d?>%
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
        <?=$cmc_eth_symbol?>
      </div>
      <div class="cell" data-title="Value">
      €&nbsp;<?=round($cmc_eth_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($eth_buyinrate_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_eth_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_eth_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_eth_percent_change_7d?>%
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
        <?=$cmc_ltc_symbol?>
      </div>
      <div class="cell" data-title="Value">
      €&nbsp;<?=round($cmc_ltc_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($ltc_buyinrate_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_ltc_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_ltc_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_ltc_percent_change_7d?>%
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
        <?=$cmc_burst_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_burst_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$burst_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_burst_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_burst_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_burst_percent_change_7d?>%
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
        <?=$cmc_cardano_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_cardano_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$cardano_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_cardano_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_cardano_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_cardano_percent_change_7d?>%
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
        <?=$cmc_eos_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_eos_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$eos_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_eos_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_eos_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_eos_percent_change_7d?>%
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
        <?=$cmc_iota_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_iota_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$iota_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_iota_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_iota_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_iota_percent_change_7d?>%
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
        <?=$cmc_neo_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_neo_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$neo_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_neo_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_neo_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_neo_percent_change_7d?>%
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
        <?=$cmc_ripple_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_ripple_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$ripple_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_ripple_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_ripple_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_ripple_percent_change_7d?>%
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
        <?=$cmc_verge_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_verge_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$verge_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_verge_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_verge_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_verge_percent_change_7d?>%
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
        <?=$cmc_waves_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_waves_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$waves_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_waves_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_waves_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_waves_percent_change_7d?>%
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
        <?=$cmc_zcash_symbol?>
      </div>
      <div class="cell" data-title="Value">
      $&nbsp;<?=$cmc_zcash_rate?>
      </div>
      <div class="cell" data-title="buyin_target">
      $&nbsp;<?=$zcash_buyintarget?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_zcash_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_zcash_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_zcash_percent_change_7d?>%
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
