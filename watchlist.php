<?php 

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

?>