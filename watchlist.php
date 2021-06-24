<?php

// ====================
// All calculations below are aimed at simulating what would've happened if you spent 100 dollars on a coin
// ====================

foreach ($buyinRates['watchlist'] as $key => $value) {
    $balanceTotals['watchlist']["$key"] = ( "100" / $value['buyinrate']);
    $buyinCosts['watchlist']["$key"] = "100";
}

$transferFee['watchlist'] = $binanceWithdrawalFeeResult;
$tradeFee['watchlist'] = $binanceTradeFeeResult;

foreach ($balanceTotals['watchlist'] as $key => $amount) {
    if (array_key_exists("$key",$cmcRates)) {
        $exitCosts['watchlist']["$key"] = ( ( $balanceTotals['watchlist']["$key"] * $tradeFee['watchlist'] ) * $cmcRates["$key"]['price'] ) + ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
    }
    else {
        $exitCosts['watchlist']["$key"] = ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
    }
}

foreach ($balanceTotals['watchlist'] as $key => $amount) {
        if (isset($cmcRates["$key"]['price'])) {
            $profit['watchlist']["$key"]['profit'] = ( $balanceTotals['watchlist']["$key"] * $cmcRates["$key"]['price'] ) - $buyinCosts['watchlist']["$key"];
            $profitPercent['watchlist']["$key"]['profitpercent'] = ( $profit['watchlist']["$key"]['profit'] / $buyinCosts['watchlist']["$key"] ) * '100';
            $exitProfit['watchlist']["$key"]['exitprofit'] = ( $balanceTotals['watchlist']["$key"] * $cmcRates["$key"]['price'] ) - ( $buyinCosts['watchlist']["$key"] + $exitCosts['watchlist']["$key"] );
            $exitProfitPercent['watchlist']["$key"]['exitprofitpercent'] = ( $exitProfit['watchlist']["$key"]['exitprofit'] / $buyinCosts['watchlist']["$key"] ) * '100';
        }
	else {
            $profit['watchlist']["$key"]['profit'] = "N/A";
            $profitPercent['watchlist']["$key"]['profitpercent'] = "N/A";
            $exitProfit['watchlist']["$key"]['exitprofit'] = "N/A";
            $exitProfitPercent['watchlist']["$key"]['exitprofitpercent'] = "N/A";
        }
}



// ====================
// Create a specific array with the calculated values per location and per coin, as well as totals
// This array is to be used for display purposes only
// ====================

foreach($profit['watchlist'] as $key => $value) {
    if(isset($cmcRates["$key"])) {
        $displayArray['watchlist']["$key"] = $cmcRates["$key"] + $profit['watchlist']["$key"] + $profitPercent['watchlist']["$key"] + $exitProfit['watchlist']["$key"] + $exitProfitPercent['watchlist']["$key"];
        array_splicek($displayArray['watchlist']["$key"],1,0,$buyinRates['watchlist']["$key"]);
    }
}

?>
