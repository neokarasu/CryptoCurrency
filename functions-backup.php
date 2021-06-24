<?php

// Function to use curl to get data from an API
// $headers should be an array for the actual headers to be used or omitted entirely

function curl_get_contents($curlUrl,$headers = NULL) {

    // Initiate the curl session
    $curlHandler = curl_init();

    // Set the URL
    curl_setopt($curlHandler, CURLOPT_URL, $curlUrl);

    // Check if headers were null or given. If given then set the headers. Otherwise don't.
    if($headers !== NULL) {

        // Set the headers
        curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $headers);
    }

    // Removes the headers from the output
    curl_setopt($curlHandler, CURLOPT_HEADER, 0);

    // Return the output instead of displaying it directly
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);

    // Execute the curl session
    $curlOutput = curl_exec($curlHandler);

    // Close the curl session
    curl_close($curlHandler);

    // Return the output as a variable
    return $curlOutput;
}



// Function to use curl to post data for API responses
// $headers should be an array for the actual headers to be used or omitted entirely
// $data should be an array with the actual data to be used or omitted entirely

function curl_post($curlUrl,$headers = NULL, $data = NULL) {

    // Initiate the curl session
    $curlHandler = curl_init();

    // Set the URL
    curl_setopt($curlHandler, CURLOPT_URL, $curlUrl);

    // Check if headers were null or given.
    // If given then set the headers. Otherwise don't.

        if($headers !== NULL) {

            // Set the headers
            curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $headers);
        }

	if($data !== NULL) {

            // Set the data
	    curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $data);
	}

    // Removes the headers from the output
    curl_setopt($curlHandler, CURLOPT_HEADER, 0);

    // Post settings
    curl_setopt($curlHandler, CURLOPT_POST, TRUE);

    // Return the output instead of displaying it directly
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);

    // Execute the curl session
    $curlOutput = curl_exec($curlHandler);

    // Close the curl session
    curl_close($curlHandler);

    // Return the output as a variable
    return $curlOutput;
}



// Function to be able to splice items into arrays while preserving associative keys
// Use similar to array_splice with regards to parameters to enter

function array_splicek(&$array, $offset, $length, $replacement) {

    // If the replacement isn't an array already then make it one
    if (!is_array($replacement)) {
        $replacement = array($replacement);
    }

    // Slice the array, then put the two parts back together with the replacement part at the desired spot
    $out = array_slice($array, $offset, $length);
    $array = array_slice($array, 0, $offset, true) + $replacement + array_slice($array, $offset + $length, NULL, true);
    return $out;
}



// Function to build the table for a singular source, e.g.'paper', 'binance' or 'bitfinex'
// $array is an array with the data, which needs to be properly set up first to match the headers

function build_table($array) {

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
                    $html .= '<td class="value">' . '$ ' . number_format($value2, 2, '.', ',') . '</td>';
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

function build_table_summary($array){

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
                    $html .= '<td class="value">' . '$ ' . number_format($value2, 2, '.', ',') . '</td>';
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
