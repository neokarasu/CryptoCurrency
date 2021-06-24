<?php

// ====================
// Create multi-dimensional arrays with all the results for paper, Binance and Bitfinex to use for the calculations.
// ====================

// Create a location array for foreach loops with multidimensional arrays that are categorised in paper, Binance and Bitfinex

$currencyLocations = array('paper', 'binance', 'bitfinex');

// Create a multidimensional array with the amounts per coin from the balances for paper, Binance and Bitfinex

$balanceTotals['paper'] = array('BTC' => "$paperBalanceAmountBTC", 'ETH' => "$paperBalanceAmountETH", 'LTC' => "$paperBalanceAmountLTC");
$balanceTotals['binance'] = $binanceBalanceResult;
$balanceTotals['bitfinex'] = $bitfinexBalanceResult;

// Create a multidimensional array with all the buyin costs for the coins categorized in paper, binance and bitfinex
// e.g. $buyinCosts['paper']['BTC']
// If a coin is missing from the buyin rates array, assume it's a free coin

$buyinCosts = array();

foreach ($currencyLocations as $location) {
    foreach ($balanceTotals["$location"] as $key => $amount) {
        if(isset($buyinRates["$location"]["$key"]['buyinrate'])) {
            $buyinCosts["$location"]["$key"] = $amount * $buyinRates["$location"]["$key"]['buyinrate'];
        }
        else {
            $buyinCosts["$location"]["$key"] = $amount * '0';
        }
    }
}

// Create a multidimensional array with all the transfer fees for the coins, categorized in paper, Binance and Bitfinex

$transferFee['paper'] = array(
    'ETH' => "$paperTransferFeeETH",
    'BTC' => "$paperTransferFeeBTC",
    'LTC' => "$paperTransferFeeLTC",
);

$transferFee['binance'] = $binanceWithdrawalFeeResult;
$transferFee['bitfinex'] = $bitfinexWithdrawalFeeResult;

// Create a multidimensional array with all the trade fees, categorized in Binance and Bitfinex
// Binance works with tradepairs, bitfinex works with maker and taker fee

$tradeFee['binance'] = $binanceTradeFeeResult;
$tradeFee['bitfinex'] = $bitfinexTradeFeeResult;



// ====================
// Perform all the calculations of which the results will be shown in tables on the website
// Assumed method for exit: transfer the coins in question to Binance, trade it to fiat and then withdraw the fiat
// All exit costs are in dollars. All cost/profit calculations are dollars unless specified otherwise
// ====================

// Calculate the exit costs for paper

$exitCosts = array();

foreach ($balanceTotals['paper'] as $key => $amount) {
    $exitCosts['paper']["$key"] = ( ( ( $balanceTotals['paper']["$key"] - $transferFee['paper']["$key"] ) * $binanceTradeFeeResult ) * $cmcRates["$key"]['price'] ) + ( $transferFee['paper']["$key"] * $cmcRates["$key"]['price'] ) + ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
}

// Calculate the exit costs for Bitfinex
// If the cryptocoin symbol isn't the same or missing at CoinMarketCap and/or the transfer/withdrawal fee at Bitfinex is missing  then the calculation is not realistic
// In that case only the fiatwithdrawal costs at Binance are considered, disregarding any costs for transferring from Bitfinex to Binance and trading to fiat
// Purposefully ignored the Binance tradefee from LTC to fiat

foreach ($balanceTotals['bitfinex'] as $key => $amount) {
    if (isset($transferFee['bitfinex']["$key"])) {
        if (isset($cmcRates["$key"]['price'])) {
            $exitCosts['bitfinex']["$key"] = ( ( ( $balanceTotals['bitfinex']["$key"] - $transferFee['bitfinex']["$key"] ) * $binanceTradeFeeResult ) * $cmcRates["$key"]['price'] ) + ( $transferFee['bitfinex']["$key"] * $cmcRates["$key"]['price'] ) + ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
        }
        else {
        $exitCosts['bitfinex']["$key"] = ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
        }
    }
    else {
        if (isset($cmcRates["$key"]['price'])) {
            $exitCosts['bitfinex']["$key"] = ( ( ( $balanceTotals['bitfinex']["$key"] - "0" ) * $binanceTradeFeeResult ) * $cmcRates["$key"]['price'] ) + ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
        }
        else {
        $exitCosts['bitfinex']["$key"] = ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
        }
    }
}

// Calculate the exit costs for Binance
// If the cryptocoin symbol isn't the same or missing at CoinMarketCap then the calculation is not realistic
// In that case only the fiatwithdrawal costs at Binance are considered, disregarding any costs for trading to fiat

foreach ($balanceTotals['binance'] as $key => $amount) {
    if (array_key_exists("$key",$cmcRates)) {
        $exitCosts['binance']["$key"] = ( ( $balanceTotals['binance']["$key"] * $binanceTradeFeeResult ) * $cmcRates["$key"]['price'] ) + ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
    }
    else {
        $exitCosts['binance']["$key"] = ( $binanceFiatWithdrawalCost / $fiatExchangeDataUSD );
    }
}

// Calculate the profit, its percentages, exitprofit and its percentages for paper, Binance and Bitfinex.
// Put them in multidimensional arrays with keys 'paper', 'binance' and 'bitfinex' and the currency
// If it happens to be a coin that doesn't have a rate at CoinMarketCap, return "N/A" and in case of no buyincosts, use 1 to avoid division by zero

foreach ($currencyLocations as $location) {
    foreach ($balanceTotals["$location"] as $key => $amount) {
        if (isset($cmcRates["$key"]['price'])) {
            if (isset($buyinCosts["$location"]["$key"])) {
                $profit["$location"]["$key"]['profit'] = ( $balanceTotals["$location"]["$key"] * $cmcRates["$key"]['price'] ) - $buyinCosts["$location"]["$key"];
                $profitPercent["$location"]["$key"]['profitpercent'] = ( $profit["$location"]["$key"]['profit'] / $buyinCosts["$location"]["$key"] ) * '100';
               	$exitProfit["$location"]["$key"]['exitprofit'] = ( $balanceTotals["$location"]["$key"] * $cmcRates["$key"]['price'] ) - ( $buyinCosts["$location"]["$key"] + $exitCosts["$location"]["$key"] );
                $exitProfitPercent["$location"]["$key"]['exitprofitpercent'] = ( $exitProfit["$location"]["$key"]['exitprofit'] / $buyinCosts["$location"]["$key"] ) * '100';

            }
            elseif ($buyinCosts["$location"]["$key"] = '0') {
                $profit["$location"]["$key"]['profit'] = ( $balanceTotals["$location"]["$key"] * $cmcRates["$key"]['price'] );
                $profitPercent["$location"]["$key"]['profitpercent'] = ( $profit["$location"]["$key"]['profit'] / '1' ) * '100';
                $exitProfit["$location"]["$key"]['exitprofit'] = ( $balanceTotals["$location"]["$key"] * $cmcRates["$key"]['price'] ) - ( $exitCosts["$location"]["$key"] );
                $exitProfitPercent["$location"]["$key"]['exitprofitpercent'] = ( $exitProfit["$location"]["$key"]['exitprofit'] / '1' ) * '100';
            }
            else {
                $profit["$location"]["$key"]['profit'] = ( $balanceTotals["$location"]["$key"] * $cmcRates["$key"]['price'] );
                $profitPercent["$location"]["$key"]['profitpercent'] = ( $profit["$location"]["$key"]['profit'] / '1' ) * '100';
                $exitProfit["$location"]["$key"]['exitprofit'] = ( $balanceTotals["$location"]["$key"] * $cmcRates["$key"]['price'] ) - ( $exitCosts["$location"]["$key"] );
                $exitProfitPercent["$location"]["$key"]['exitprofitpercent'] = ( $exitProfit["$location"]["$key"]['exitprofit'] / '1' ) * '100';
            }
        }
	else {
            $profit["$location"]["$key"]['profit'] = "N/A";
            $profitPercent["$location"]["$key"]['profitpercent'] = "N/A";
            $exitProfit["$location"]["$key"]['exitprofit'] = "N/A";
            $exitProfitPercent["$location"]["$key"]['exitprofitpercent'] = "N/A";
        }
    }
}



// Calculate the summary profit percentages and exit profit percentages for paper, Binance and Bitfinex.
// Put them in multidimensional arrays with keys 'paper', 'binance' and 'bitfinex'
// In case of no buyincosts, use 1 to avoid division by zero

foreach ($currencyLocations as $location) {
    if (array_sum($buyinCosts["$location"]) == '0') {
        $summaryProfitPercent["$location"]['summaryprofitpercent'] = ( array_sum(array_column($profit["$location"],'profit')) / '1' ) * '100';
        $summaryExitProfitPercent["$location"]['summaryexitprofitpercent'] = ( array_sum(array_column($exitProfit["$location"],'exitprofit'))  / '1' ) * '100';
    }
    else {
        $summaryProfitPercent["$location"]['summaryprofitpercent'] = ( array_sum(array_column($profit["$location"],'profit'))  / array_sum($buyinCosts["$location"]) ) * '100';
        $summaryExitProfitPercent["$location"]['summaryexitprofitpercent'] = ( array_sum(array_column($exitProfit["$location"],'exitprofit'))  / array_sum($buyinCosts["$location"]) ) * '100';
    }
}



// ====================
// Create a specific array with the calculated values per location and per coin, as well as totals
// This array is to be used for display purposes only
// ====================

foreach ($currencyLocations as $location) {
    foreach($profit["$location"] as $key => $value) {
        if(isset($cmcRates["$key"])) {
            $displayArray["$location"]["$key"] = $cmcRates["$key"] + $profit["$location"]["$key"] + $profitPercent["$location"]["$key"] + $exitProfit["$location"]["$key"] + $exitProfitPercent["$location"]["$key"];
            array_splicek($displayArray["$location"]["$key"],1,0,$buyinRates["$location"]["$key"]);
        }
    }
}

// Calculate the totals for the profit, its percentages, exitprofit and its percentages for paper, Binance and Bitfinex.
// Put them in arrays with keys 'paper', 'binance' and 'bitfinex'

foreach ($currencyLocations as $location) {
    $displayArray['total']['paper']["location"] = "Paper Wallet";
    $displayArray['total']['binance']["location"] = "Binance";
    $displayArray['total']['bitfinex']["location"] = "Bitfinex";
    $displayArray['total']["$location"]["profit"] = array_sum(array_column($profit["$location"],'profit'));
    $displayArray['total']["$location"]["profitpercent"] = $summaryProfitPercent["$location"]['summaryprofitpercent'];
    $displayArray['total']["$location"]["exitprofit"] = array_sum(array_column($exitProfit["$location"],'exitprofit'));
    $displayArray['total']["$location"]["exitprofitpercent"] = $summaryExitProfitPercent["$location"]['summaryexitprofitpercent'];
}

?>
