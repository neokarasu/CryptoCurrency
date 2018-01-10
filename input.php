<?php

// This file is for assigning static variables for calculations and public keys 
// Dirty cause no database
// Use a dot for decimal points, not a comma

// The public key of your wallets of LTC, ETH and BTC. 1 per currency

$btc_publickey = "";
$eth_publickey = "";
$ltc_publickey = "";

// The amounts of your wallets on Bitfinex. 1 per currency.

$bfn_bch_amount = "";
$bfn_etc_amount = "";
$bfn_iota_amount = "";
$bfn_xmr_amount = "";
$bfn_xrp_amount = "";

// The amounts of your wallets on Binance. 1 per currency.

$bin_ada_amount = "";
$bin_neo_amount = "";
$bin_ven_amount = "";
$bin_ltc_amount = "";
$bin_btc_amount = "";

// The exchange rate at the time of purchase, in dollars. bfn for Bitfinex, bin for Binance.

$paper_btc_buyinrate = "";
$paper_eth_buyinrate = "";
$paper_ltc_buyinrate = "";

$bfn_bch_buyinrate = "";
$bfn_etc_buyinrate = "";
$bfn_iota_buyinrate = "";
$bfn_xmr_buyinrate = "";
$bfn_xrp_buyinrate = "";

$bin_ada_buyinrate = "";
$bin_neo_buyinrate = "";
$bin_ven_buyinrate = "";
$bin_ltc_buyinrate = "";
$bin_btc_buyinrate = "";

// The total amount you paid to get the amount of that currency, in dollars. bfn for Bitfinex, bin for Binance.

$paper_btc_totalbuyin = "";
$paper_eth_totalbuyin = "";
$paper_ltc_totalbuyin = "";

$bfn_bch_totalbuyin = "";
$bfn_etc_totalbuyin = "";
$bfn_iota_totalbuyin = "";
$bfn_xmr_totalbuyin = "";
$bfn_xrp_totalbuyin = "";

$bin_ada_totalbuyin = "";
$bin_neo_totalbuyin = "";
$bin_ven_totalbuyin = "";
$bin_ltc_totalbuyin = "";
$bin_btc_totalbuyin = "";

// The transfer fee for a currency in the currency specified. bfn for Bitfinex

$btc_transferfee = "0.00119780";
$eth_transferfee = "0.000987";
$ltc_transferfee  = "0.01";

$bch_transferfee = "0.00000226";
$etc_transferfee = "0.00088";
$iota_transferfee = "0";
$xmr_transferfee = "0.03";
$xrp_transferfee = "0.0125";

$ada_transferfee = "0.2";
$neo_transferfee = "0";
$ven_transferfee = "0.6";

$bfn_bch_withdrawalfee = "0.0001";
$bfn_etc_withdrawalfee = "0.01";
$bfn_iota_withdrawalfee = "0.5";
$bfn_xmr_withdrawalfee = "0.04";
$bfn_xrp_withdrawalfee = "0.02";

$bin_ada_withdrawalfee = "1";
$bin_neo_withdrawalfee = "0";
$bin_ven_withdrawalfee = "5";
$bin_ltc_withdrawalfee = "0.01";
$bin_btc_withdrawalfee = "0.001";

// The target buyin for coins you're watching

$burst_buyintarget = "";
$eos_buyintarget = "";
$verge_buyintarget = "";
$waves_buyintarget = "";
$zcash_buyintarget = "";

// The transfer fee for a transfer in the currency specified, for coins you're watching

$burst_transferfee  = "";
$eos_transferfee  = "";
$verge_transferfee  = "";
$waves_transferfee  = "";
$zcash_transferfee  = "";

?>
