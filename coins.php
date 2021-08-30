<?php

require 'input.php';
require 'functions-utility.php';
require 'binance.php';
require 'bitfinex.php';
require 'paper.php';
require 'coinmarketcap.php';
require 'fiatexchange.php';
require 'calculations.php';
require 'watchlist.php';
require 'functions-display.php';

session_start();

if(!isset($_SESSION['UserData']['Username'])) {
    header("location:index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<title>Cryptocurrency</title>
<link rel="stylesheet" type="text/css" href="coinstyle.css" />
</head>


<body>

<div class="tabmenu">
    <button class="tablinks" data-tab="Summary" id="defaultOpen">Summary</button>
    <button class="tablinks" data-tab="Paper Wallet">Paper Wallet</button>
    <button class="tablinks" data-tab="Binance">Binance</button>
    <button class="tablinks" data-tab="Bitfinex">Bitfinex</button>
    <button class="tablinks" data-tab="Watchlist">Watchlist</button>
</div>

<div id="Summary" class="tabcontent" align="center" style="overflow-x:auto;">
    <table>
        <tr class="header blue">
            <td>Summary (in dollars)</td>
        </tr>
    </table>
    <?php echo build_table_summary($displayArray['total']); ?>
    <table>
        <tr class="header blue">
            <td>Summary (in euros)</td>
        </tr>
    </table>
    <?php echo build_table_summary($displayArray['total'],"euro",$fiatExchangeDataUSD); ?>
</div>

<div id="Paper Wallet" class="tabcontent" align="center">
    <table>
        <tr class="header blue">
            <td>CoinMarketCap (in dollars)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['paper']); ?>
    <table>
        <tr class="header blue">
            <td>CoinMarketCap (in euros)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['paper'], "euro",$fiatExchangeDataUSD); ?>
</div>

<div id="Binance" class="tabcontent" align="center">
    <table>
        <tr class="header blue">
            <td>Binance (in dollars)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['binance']); ?>
    <table>
        <tr class="header blue">
            <td>Binance (in euros)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['binance'], "euro", $fiatExchangeDataUSD); ?>
</div>

<div id="Bitfinex" class="tabcontent" align="center">
    <table>
        <tr class="header blue">
            <td>Bitfinex (in dollars)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['bitfinex']); ?>
    <table>
        <tr class="header blue">
            <td>Bitfinex (in euros)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['bitfinex'], "euro",$fiatExchangeDataUSD); ?>
</div>

<div id="Watchlist" class="tabcontent" align="center">
    <table>
        <tr class="header blue">
            <td>Watchlist (in dollars)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['watchlist']); ?>
    <table>
        <tr class="header blue">
            <td>Watchlist (in euros)</td>
        </tr>
    </table>
    <?php echo build_table($displayArray['watchlist'], "euro",$fiatExchangeDataUSD); ?>
</div>

<div class="logout table header green">
    <a href="logout.php">Click here</a> to Logout
</div>
<script src="tabs.js"></script>
</body>
</html>
