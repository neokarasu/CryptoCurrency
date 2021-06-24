<?php

// Function to build the table for a singular source, e.g.'paper', 'binance' or 'bitfinex'
// $array is an array with the data, which needs to be properly set up first to match the headers

function build_table($array,$fiat = "dollar",$fiatExchangeDataUSD = "1") {

    // Start the table
    $html = '<table>';

    // Add the header row, predefined for prettier headers than array keys
    $html .= '<thead>';
    $html .= '<tr class= "header green">';
    $html .= '<th class="name">' .'Coin Name' . '</th>';
    $html .= '<th>' .'Buyin<br>Price' . '</th>';
    $html .= '<th>' .'Price' . '</td>';
    $html .= '<th>' .'Change<br>1hour' . '</th>';
    $html .= '<th>' .'Change<br>24hours' . '</th>';
    $html .= '<th>' .'Change<br>7days' . '</th>';
    $html .= '<th>' .'Profit' . '</th>';
    $html .= '<th>' .'Profit %' . '</th>';
    $html .= '<th>' .'Exit<br>Profit' . '</th>';
    $html .= '<th>' .'Exit<br>Profit %' . '</th>';


    $html .= '</tr>';
    $html .= '</thead>';

   // Add the content row of the table with a loop depending on the array's content

    $html .= '<tbody>';

    foreach($array as $key=>$value) {
        $html .= '<tr class= "row">';
        foreach($value as $key2=>$value2){
            if ($key2 === array_key_first($array["$key"])) {
                $html .= '<td class="name">' . "$value2" . '</td>';
            }


            else {
                if(strpos($key2,"percent") !== false) {
                    $html .= '<td class="value">' . number_format($value2, 2, '.', ',')  . ' %' . '</td>';
                }
                else {
                    if ($fiat == "euro") {
                    $html .= '<td class="value">' . '€ ' . number_format(($value2*$fiatExchangeDataUSD), 2, '.', ',') . '</td>';
                    }
                    else {
                    $html .= '<td class="value">' . '$ ' . number_format($value2, 2, '.', ',') . '</td>';
                    }
                }
            }
        }
        $html .= '</tr>';
    }

    $html .= '</tbody>';

    // Finish the table and return it

    $html .= '</table>';
    return $html;
}



// Function to build the summary table for an overview of all sources e.g.'paper', 'binance' or 'bitfinex'
// $array is an array with the data, which needs to be properly set up first to match the headers

function build_table_summary($array,$fiat = "dollar",$fiatExchangeDataUSD = "1") {

    // Start the table
    $html = '<table>';

    // Add the header row, predefined for prettier headers than array keys

    $html .= '<tr class= "header green">';
    $html .= '<th>' .'Type' . '</th>';
    $html .= '<th>' .'Profit' . '</th>';
    $html .= '<th>' .'Profit %' . '</th>';
    $html .= '<th>' .'Exit Profit' . '</th>';
    $html .= '<th>' .'Exit Profit %' . '</th>';
    $html .= '</tr>';

    // Add the content row of the table with a loop depending on the array's content

    foreach( $array as $key=>$value){
        $html .= '<tr class= "row">';
        foreach($value as $key2=>$value2){
            if ($key2 === array_key_first($array["$key"])) {
                $html .= '<td class="name">' . "$value2" . '</td>';
            }
            else {
                if(strpos($key2,"percent") !== false) {
                    $html .= '<td class="value">' . number_format($value2, 2, '.', ',')  . ' %' . '</td>';
                }
                else {
                    if ($fiat == "euro") {
                    $html .= '<td class="value">' . '€ ' . number_format(($value2*$fiatExchangeDataUSD), 2, '.', ',') . '</td>';
                    }
                    else {
                    $html .= '<td class="value">' . '$ ' . number_format($value2, 2, '.', ',') . '</td>';
                    }
                }
            }
        }
        $html .= '</tr>';
    }

    // Finish the table and return it

    $html .= '</table>';
    return $html;
}

?>
