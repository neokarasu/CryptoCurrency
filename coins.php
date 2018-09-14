<?php 
session_start();

// Check session

if(!isset($_SESSION['UserData']['Username'])){
	header("location:index.php");
	exit;
}

// All static variables and everything that needs to be manually input in input.php

require 'input.php';

// All the balance information is in balance.php

require 'balance.php';

// API calls and everything for eur-usd fiat exchange in fiatexchange.php

require 'fiatexchange.php';

// API calls and calculations for coinmarketcap tabs in coinmarketcap.php

require 'coinmarketcap.php';

// API calls and calculations for bitfinex tabs in bitfinex.php

require 'bitfinex.php';

// API calls and calculations for binance tabs in binance.php

require 'binance.php';

// All the watchlist information is in watchlist.php 

require 'watchlist.php';

// Create variables for the summary tab

$summary_totalbuyin = $paper_btc_totalbuyin + $paper_eth_totalbuyin + $paper_ltc_totalbuyin + $bin_ada_totalbuyin + $bin_neo_totalbuyin + $bin_vet_totalbuyin + $bin_btc_totalbuyin + $bin_ltc_totalbuyin + $bfn_bch_totalbuyin + $bfn_etc_totalbuyin + $bfn_iota_totalbuyin + $bfn_xmr_totalbuyin + $bfn_xrp_totalbuyin;

$summary_total_profit = $paper_total_profit + $bfn_total_profit + $bin_total_profit;

$summary_percent_profit = ($summary_total_profit / $summary_totalbuyin) * 100;

?>

<html>
<head>
<title>Cryptocurrency</title>
<link rel="stylesheet" type="text/css" href="coinstyle.css" />
<script src="tabs.js"></script>
</head>
<body>

<div class="tab">
  <button class="tablinks" onclick="openTabcontent(event, 'Summary')">Summary</button>
  <button class="tablinks" onclick="openTabcontent(event, 'PaperWallet')">Paper Wallet</button>
  <button class="tablinks" onclick="openTabcontent(event, 'Bitfinex')">Bitfinex</button>
  <button class="tablinks" onclick="openTabcontent(event, 'Binance')">Binance</button>
  <button class="tablinks" onclick="openTabcontent(event, 'Watchlist')">Watchlist</button>
</div>

<!-- Content of the Summary tab goes here -->

<div id="Summary" class="tabcontent" align="center">

<div class="wrapper">

<div class="table">
  <div class="row header blue" style="display:table-row">
    <div class="cell">Summary (in dollars)</div>
  </div>
</div>
<div class="table">
<div class="row header green">
      <div class="cell">
        Type
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
</div>

<div class="row">
      <div class="cell" data-title="WalletType">
        Paper Wallet
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($paper_total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
      <?=round($paper_total_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="WalletType">
        Bitfinex
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bfn_total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
      <?=round($bfn_total_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="WalletType">
        Binance
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bin_total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
      <?=round($bin_total_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="empty">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($summary_total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
      <?=round($summary_percent_profit, 2)?>%
      </div>
</div>

</div>

</div>

</div>

<!-- End of content of the Summary tab -->


<!-- Content of the Paper Wallet tab goes here -->

<div id="PaperWallet" class="tabcontent" align="center">

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
        Rate
      </div>
      <div class="cell">
        Buyin Rate
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
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$cmc_btc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$paper_btc_buyinrate?>
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
      $&nbsp;<?=round($paper_btc_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_btc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($paper_btc_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_btc_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Ethereum
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_eth_symbol?>
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$cmc_eth_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$paper_eth_buyinrate?>
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
      $&nbsp;<?=round($paper_eth_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
       <?=round($paper_eth_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($paper_eth_exitprofit, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_eth_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Litecoin
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_ltc_symbol?>
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$cmc_ltc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$paper_ltc_buyinrate?>
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
      $&nbsp;<?=round($paper_ltc_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_ltc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($paper_ltc_exitprofit, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_ltc_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        WePower
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_wpr_symbol?>
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$cmc_wpr_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$paper_wpr_buyinrate?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_wpr_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_wpr_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_wpr_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($paper_wpr_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_wpr_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($paper_wpr_exitprofit, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_wpr_percent_exitprofit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        &nbsp;
      </div>
      <div class="cell" data-title="Symbol">
        &nbsp;
      </div>
      <div class="cell" data-title="Rate">
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
      $&nbsp;<?=round($paper_total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_total_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit_minus_fees">
      $&nbsp;<?=round($paper_total_exitprofit, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_total_percent_exitprofit, 2)?>%
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
        Rate
      </div>
      <div class="cell">
        Buyin Rate
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
      <div class="cell" data-title="Rate">
      €&nbsp;<?=round($cmc_btc_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($paper_btc_buyinrate_eu, 2)?>
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
      €&nbsp;<?=round($paper_btc_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_btc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($paper_btc_exitprofit_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_btc_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Ethereum
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_eth_symbol?>
      </div>
      <div class="cell" data-title="Rate">
      €&nbsp;<?=round($cmc_eth_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($paper_eth_buyinrate_eu, 2)?>
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
      €&nbsp;<?=round($paper_eth_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
       <?=round($paper_eth_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($paper_eth_exitprofit_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_eth_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Litecoin
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_ltc_symbol?>
      </div>
      <div class="cell" data-title="Rate">
      €&nbsp;<?=round($cmc_ltc_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($paper_ltc_buyinrate_eu, 2)?>
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
      €&nbsp;<?=round($paper_ltc_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_ltc_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($paper_ltc_exitprofit_eu, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_ltc_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        WePower
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_wpr_symbol?>
      </div>
      <div class="cell" data-title="Rate">
      €&nbsp;<?=round($cmc_wpr_rate_eu, 3)?>
      </div>
      <div class="cell" data-title="buyin_rate">
      €&nbsp;<?=round($paper_wpr_buyinrate_eu, 2)?>
      </div>
      <div class="cell" data-title="percent_change_1h">
        <?=$cmc_wpr_percent_change_1h?>%
      </div>
      <div class="cell" data-title="percent_change_24h">
        <?=$cmc_wpr_percent_change_24h?>%
      </div>
      <div class="cell" data-title="percent_change_7d">
        <?=$cmc_wpr_percent_change_7d?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      €&nbsp;<?=round($paper_wpr_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_wpr_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($paper_wpr_exitprofit_eu, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_wpr_percent_exitprofit, 2)?>%
      </div>

</div>

<div class="row">
      <div class="cell" data-title="Coin">
        &nbsp;
      </div>
      <div class="cell" data-title="Symbol">
        &nbsp;
      </div>
      <div class="cell" data-title="Rate">
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
      €&nbsp;<?=round($paper_total_profit_eu, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($paper_total_percent_profit, 2)?>%
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit_minus_fees">
      €&nbsp;<?=round($paper_total_exitprofit_eu, 2 )?>
      </div>
      <div class="cell" data-title="percent_profit_minus_fees">
        <?=round($paper_total_percent_exitprofit, 2)?>%
      </div>

</div>
</div>
</div>

</div>

<!-- End of content of the Paper Wallet tab. -->

<!-- Content of the Bitfinex tab goes here -->

<div id="Bitfinex" class="tabcontent" align="center">

<!-- First table for USD prices -->

<div class="wrapper">

<div class="table">
  <div class="row header blue" style="display:table-row">
    <div class="cell">Bitfinex (in dollars)</div>
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
        Rate
      </div>
      <div class="cell">
        Buyin Rate
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
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Bitcoin Cash
      </div>
      <div class="cell" data-title="Symbol">
        BCH
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bfn_bch_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bfn_bch_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bfn_bch_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        N/A
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Ethereum Classic
      </div>
      <div class="cell" data-title="Symbol">
        ETC
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bfn_etc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bfn_etc_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bfn_etc_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        N/A
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Iota
      </div>
      <div class="cell" data-title="Symbol">
        Iota
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bfn_iota_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bfn_iota_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bfn_iota_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($bfn_iota_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Monero
      </div>
      <div class="cell" data-title="Symbol">
        XMR
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bfn_xmr_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bfn_xmr_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bfn_xmr_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($bfn_xmr_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Ripple
      </div>
      <div class="cell" data-title="Symbol">
        XRP
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bfn_xrp_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bfn_xrp_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bfn_xrp_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($bfn_xrp_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        &nbsp;
      </div>
      <div class="cell" data-title="Symbol">
        &nbsp;
      </div>
      <div class="cell" data-title="Rate">
        &nbsp;
      </div>
      <div class="cell" data-title="buyin_rate">
        &nbsp;
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bfn_total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($bfn_total_percent_profit, 2)?>%
      </div>
</div>

</div>

</div>

</div>

<!-- End of content of the Bitfinex tab -->

<!-- Content of the Binance tab goes here -->

<div id="Binance" class="tabcontent" align="center">

<!-- First table for USD prices -->

<div class="wrapper">

<div class="table">
  <div class="row header blue" style="display:table-row">
    <div class="cell">Binance (in dollars)</div>
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
        Rate
      </div>
      <div class="cell">
        Buyin Rate
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
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Cardano
      </div>
      <div class="cell" data-title="Symbol">
        ADA
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bin_ada_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bin_ada_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bin_ada_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($bin_ada_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Neo
      </div>
      <div class="cell" data-title="Symbol">
        Neo
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bin_neo_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bin_neo_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bin_neo_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($bin_neo_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        VeChain
      </div>
      <div class="cell" data-title="Symbol">
        Vet
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bin_vet_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bin_vet_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bin_vet_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
        <?=round($bin_vet_percent_profit, 2)?>%
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Litecoin
      </div>
      <div class="cell" data-title="Symbol">
        LTC
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bin_ltc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bin_ltc_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bin_ltc_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
      N/A
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        Bitcoin
      </div>
      <div class="cell" data-title="Symbol">
        BTC
      </div>
      <div class="cell" data-title="Rate">
      $&nbsp;<?=$bin_btc_rate?>
      </div>
      <div class="cell" data-title="buyin_rate">
      $&nbsp;<?=$bin_btc_buyinrate?>
      </div>
      <div class="cell" data-title="empty">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bin_btc_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
      N/A
      </div>
</div>

<div class="row">
      <div class="cell" data-title="Coin">
        &nbsp;
      </div>
      <div class="cell" data-title="Symbol">
        &nbsp;
      </div>
      <div class="cell" data-title="Rate">
        &nbsp;
      </div>
      <div class="cell" data-title="buyin_rate">
        &nbsp;
      </div>
      <div class="cell" data-title="empty">
        Total:
      </div>
      <div class="cell" data-title="profit">
      $&nbsp;<?=round($bin_total_profit, 2)?>
      </div>
      <div class="cell" data-title="profit %">
      <?=round($bin_total_percent_profit, 2)?>%
      </div>
</div>

</div>

</div>

</div>

<!-- End of content of the Binance tab -->

<!-- Content of the Watchlist tab goes here -->

<div id="Watchlist" class="tabcontent" align="center">

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
        Rate
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
      <div class="cell" data-title="Rate">
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
        Eos
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_eos_symbol?>
      </div>
      <div class="cell" data-title="Rate">
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
        Verge (XVG)
      </div>
      <div class="cell" data-title="Symbol">
        <?=$cmc_verge_symbol?>
      </div>
      <div class="cell" data-title="Rate">
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
      <div class="cell" data-title="Rate">
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
      <div class="cell" data-title="Rate">
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

<!-- Log out option below here -->

<div class="logout table" style="border: 1px" align="center">
  <div class="row header green"  align="center">
    <div class="cell" align="center"><a href="logout.php">Click here</a> to Logout.</div>
  </div>
</div>

</div>

</body>
</html>
