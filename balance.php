<?php 

// Fetch the current BTC balance from the BTC public key entered. Uses etherscan.io api. 1 API call per pageload

$url = "https://blockchain.info/nl/balance?active=$btc_publickey";
$json = file_get_contents($url);
$paper_btc_amount_data = json_decode($json, TRUE);
$paper_btc_amount = ($paper_btc_amount_data["$btc_publickey"]["final_balance"]) / 100000000 ;

// Fetch the current ETH balance from the ETH public key entered. Uses etherscan.io api. 1 API call per pageload

$url = "https://api.etherscan.io/api?module=account&action=balance&address=$eth_publickey&tag=latest";
$json = file_get_contents($url);
$paper_eth_amount_data = json_decode($json, TRUE);
$paper_eth_amount = ($paper_eth_amount_data["result"]) / 1000000000000000000 ;

// Fetch the current LTC balance from the LTC public key entered. Uses the chainz.cryptoid.info api. 1 API call per pageload

$url = "https://chainz.cryptoid.info/ltc/api.dws?q=getbalance&a=$ltc_publickey";
$json = file_get_contents($url);
$paper_ltc_amount = json_decode($json, TRUE);


// Fetch the current WPR balance from the ETH public key entered. Uses etherscan.io api. 1 API call per pageload

$url = "https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=0x4CF488387F035FF08c371515562CBa712f9015d4&address=$wpr_publickey&tag=latest";
$json = file_get_contents($url);
$paper_wpr_amount_data = json_decode($json, TRUE);
$paper_wpr_amount = ($paper_wpr_amount_data["result"]) / 1000000000000000000 ;

?>