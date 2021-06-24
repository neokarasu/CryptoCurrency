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
?>
