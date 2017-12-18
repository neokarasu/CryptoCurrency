<html>
<head>
<title>Testing</title>
<link rel="stylesheet" type="text/css" href="coinstyle.css" />
</head>
<body>

<?php

// This is a single api call per page load that brings up the data for the top 10 coins from coinmarketcap
    
$url = "https://api.coinmarketcap.com/v1/ticker/?limit=10";
$json = file_get_contents($url);
$data = json_decode($json, TRUE);

// Assign names to the variables you want to show from the coinmarketcap array, where btc = 0, ethereum = 1, litecoin = 4

$btc_rate = $data[0]["price_usd"];
$btc_percent_change_1h = $data[0]["percent_change_1h"];
$btc_percent_change_24h = $data[0]["percent_change_24h"];
$btc_percent_change_7d = $data[0]["percent_change_7d"];

$eth_rate = $data[1]["price_usd"];
$eth_percent_change_1h = $data[1]["percent_change_1h"];
$eth_percent_change_24h = $data[1]["percent_change_24h"];
$eth_percent_change_7d = $data[1]["percent_change_7d"];

$ltc_rate = $data[4]["price_usd"];
$ltc_percent_change_1h = $data[4]["percent_change_1h"];
$ltc_percent_change_24h = $data[4]["percent_change_24h"];
$ltc_percent_change_7d = $data[4]["percent_change_7d"];
    
 
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


// Perform calculations here instead of in the divs, specific for exit_amonunts

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
    
// Perform calculations to convert everything to euro's for the second table
    
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

<!--First table for USD prices of coinmarketcap -->

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

<!--Second table for EUR prices of coinmarketcap -->

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

</body>
</html>

