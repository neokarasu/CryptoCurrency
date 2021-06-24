<?php

// ====================
// Fetch the balances of the paper wallets for BTC, ETH and LTC. 3 API calls per page load, 1 per API.
// ====================

// ====================
// Fetch the current BTC balances from blockchain.info for 1 total balance
// ====================

// Prepare the public keys for use and set the URL

$publicKeyBTC = implode('|',$publicKeyArrayBTC);
$paperBalanceUrlBTC = 'https://blockchain.info/balance?active=' . $publicKeyBTC;

// Perform the request and make a usable variable out of the response

$paperBalanceOutputBTC = curl_get_contents($paperBalanceUrlBTC);
$paperBalanceArrayBTC = json_decode($paperBalanceOutputBTC, TRUE);
$paperBalanceDataBTC = array_column($paperBalanceArrayBTC, 'final_balance');
$paperBalanceAmountBTC = array_sum($paperBalanceDataBTC) / '100000000';


// ====================
// Fetch the current ETH balances from etherscan.info for 1 total balance.
// ====================

// Prepare the public keys for use and set the URL

$publicKeyETH = implode(',',$publicKeyArrayETH);
$paperBalanceUrlETH = 'https://api.etherscan.io/api?module=account&action=balancemulti&address=' . $publicKeyETH . '&tag=latest&apikey=' . $etherScanApiKey;

// Perform the request and make a usable variable out of the response

$paperBalanceOutputETH = curl_get_contents($paperBalanceUrlETH);
$paperBalanceArrayETH = json_decode($paperBalanceOutputETH, TRUE);
$paperBalanceDataETH = array_column($paperBalanceArrayETH['result'], 'balance');
$paperBalanceAmountETH = array_sum($paperBalanceDataETH) / '1000000000000000000';


// ====================
// Fetch the current LTC balances from chainz.cryptoid.info for 1 total balance.
// ====================

// Prepare the public keys for use and set the URL

$publicKeyJsonLTC = json_encode($publicKeyArrayLTC);
$paperBalanceUrlLTC = 'https://chainz.cryptoid.info/ltc/api.dws?q=getbalances' . '&key=' .  $chainzCryptoidApiKey;

// Perform the request and make a usable variable out of the response

$paperBalanceOutputLTC = curl_post($paperBalanceUrlLTC, NULL ,$publicKeyJsonLTC);
$paperBalanceArrayLTC = json_decode($paperBalanceOutputLTC, TRUE);
$paperBalanceAmountLTC = array_sum($paperBalanceArrayLTC);



// ====================
// Fetch the current transfer costs for transferring paper wallet amounts for BTC, ETH and LTC via blockcypher.con with 3 API calls per page load.
// ====================

// ====================
// Get the current transfer costs for fast BTC transfers.
// Based on 226 bytes per transaction with 1 input and 2 outputs. Calculating it from satoshi to BTC by dividing it by 10^8
// ====================

$paperTransferFeeUrlBTC = 'https://api.blockcypher.com/v1/btc/main';
$paperTransferFeeOutputBTC = curl_get_contents($paperTransferFeeUrlBTC);
$paperTransferFeeArrayBTC = json_decode($paperTransferFeeOutputBTC, TRUE);
$paperTransferFeeDataBTC = $paperTransferFeeArrayBTC['high_fee_per_kb'];
$paperTransferFeeBTC = ($paperTransferFeeDataBTC * '0.226') / '100000000';

// ====================
// Get the current transfer costs for fast ETH transfers.
// Based on 21000 gas per value transaction. Ccalculating it from wei to ETH by dividing it by 10^18
// ====================

$paperTransferFeeUrlETH = 'https://api.blockcypher.com/v1/eth/main';
$paperTransferFeeOutputETH = curl_get_contents($paperTransferFeeUrlETH);
$paperTransferFeeArrayETH = json_decode($paperTransferFeeOutputETH, TRUE);
$paperTransferFeeDataETH = $paperTransferFeeArrayETH['high_gas_price'];
$paperTransferFeeETH = ($paperTransferFeeDataETH * '21000') / '1000000000000000000';

// ====================
// Get the current transfer costs for fast LTC transfers.
// Based on 226 bytes per transaction with 1 input and 2 outputs. Calculating it from satoshi to LTC by dividing it by 10^8
// ====================

$paperTransferFeeUrlLTC = 'https://api.blockcypher.com/v1/ltc/main';
$paperTransferFeeOutputLTC = curl_get_contents($paperTransferFeeUrlLTC);
$paperTransferFeeArrayLTC = json_decode($paperTransferFeeOutputLTC, TRUE);
$paperTransferFeeDataLTC = $paperTransferFeeArrayLTC['high_fee_per_kb'];
$paperTransferFeeLTC = ($paperTransferFeeDataLTC * '0.226') / '100000000';

?>
