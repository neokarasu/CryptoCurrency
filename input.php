<?php

// ====================
// Define username and password array for logging into the site
// Example: array('your-username-here' => 'your-password-here');
// ====================
$login = array('' => '');



// ====================
// Public keys for paper wallets of BTC, ETH or LTC
// Add as many as you need, just make sure the syntax is the same for each line.
// Example: $publicKeyArrayBTC[] = 'your-public-key-here';
// ====================

$publicKeyArrayBTC[] = '';
$publicKeyArrayETH[] = '';
$publicKeyArrayLTC[] = '';
$publicKeyArrayLTC[] = '';



// ====================
// Starting rates that coins were bought for, in dollars. Paper for paper wallets, bitfinex for Bitfinex and binance for Binance
// Each line goes under either binance, bitfinex or paper, follow the syntax for each line.
// Example::'symbol-of-coin' => array('buyinrate' => 'your-rate-here')
// ====================

$buyinRates['binance'] = array(
'BTC' => array('buyinrate' => ''),
'ETH' => array('buyinrate' => ''),
'LTC' => array('buyinrate' => ''),
);

$buyinRates['bitfinex'] = array(
'BTC' => array('buyinrate' => ''),
'ETH' => array('buyinrate' => ''),
'LTC' => array('buyinrate' => ''),
);

$buyinRates['paper'] = array(
'BTC' => array('buyinrate' => ''),
'ETH' => array('buyinrate' => ''),
'LTC' => array('buyinrate' => '')
);



// ====================
// Target buyin costs for the coins you're watching. Enter the amount that you want to simulate buying them at
// Make sure to only add coins that are supported according to the 'Default settings' further below in this file
// Example 'symbol-of-coin' => array('buyinrate' => 'your-rate-here'),
// ====================

$buyinRates['watchlist'] = array(
'ADA' => array('buyinrate' => ''),
'NEO' => array('buyinrate' => ''),
'VET' => array('buyinrate' => '')
);



// ====================
// Default settings including:
// - The cryptocurrencies that will be used for the CoinMarketCap API calls - indicative of what is supported
// - Default settings for Binance trade fees for all coins and the fiat withdrawal fee
// ====================

$cryptoSymbols = 'ADA,BCH,BNB,BTC,EOS,ETH,FIL,LINK,LTC,MIOTA,NEO,TRX,XLM,XRP,XVG,VET';
$binanceFiatWithdrawalCost = '0.8';
$binanceTradeFeeResult = '0.001';



// ====================
// API Keys and Secret keys for Binance and Bitfinex
// ====================

$binanceApiKey = '';
$binanceSecretKey = '';
$bitfinexApiKey = '';
$bitfinexSecretKey = '';

// ====================
// API keys for OpenExchangeRates.org, Etherscan.io, Chainz.Cryptoid.info and CoinMarketCap
// ====================

$openExchangeRatesApiKey = '';
$etherScanApiKey = '';
$chainzCryptoidApiKey = '';
$coinMarketCapApiKey = '';

?>
