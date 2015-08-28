<!DOCTYPE html>
<html>
<body>

<h1>Thanks for participating!</h1>

Please <b>do not</b> use your browser's &quot;back&quot; button. Instead, close the current tab. 

<?php
// GOAL: create a 'tidy data' .csv from appropriately formatted experimental data
// first: make a directory to store experimental data, if it doesn't already exist
// important: this script assumes that each individual trial's data is packaged as a JavaScript object (dictionary), so that its string begins with '{' and ends with '}'.
if (!file_exists('experimentData/')) {
    mkdir('experimentData/', 0777, true);
}
// then, set filename to posted value of experimentName variable
$filename = "experimentData/" . mb_substr($_POST["experimentName"], 1, -1) . ".csv";

$headerItems = array();
$trialData = array();

foreach (array_keys($_POST) as $key) {
	$value = $_POST[$key];
	if (mb_substr($value, 0, 1) == '{' and mb_substr($value, strlen($value) - 1, 1) == '}') {
// if the data starts and ends with '{', '}' then it's a complex data object representing a single trial. 
// so, add the key-value pair to $trialData array to await further processing
		$trialData[$key] = $value;
	} else {
// otherwise, it's data shared across all trials; so add the pair to the $headerItems array
		$headerItems[$key] = $value;
	}
}

// we assume that all items in $trialData have the same structure, including ALL OF THE SAME VARIABLES
// this means that you will need, in your JavaScript code, to create dummy 'NA' variables 
	// for anything that is not being recorded in a given trial

function parseTrialData ($trialData) { 
	$trialData = mb_substr($trialData, 1, -1);
		// get rid of leading '{' and trailing '}'
	$trialData = explode(',', $trialData);
		// 'explode' is PHP for 'split'
		// i.e., separate the string into an array of strings of form 'key:value'
	$parsedTrialData = array();
	foreach ($trialData as $kv) {
		$exploded = explode(':', $kv);
		// then, parse these strings into embedded arrays
		$parsedTrialData[$exploded[0]] = $exploded[1];
	}
	return $parsedTrialData;
}

// make the .csv header
// and also a string to store subject-level data that will be shared across all trials
$allTrialsGlobalData = "";

$globalHeader = "";
foreach (array_keys($headerItems) as $key) { 
	$globalHeader .= $key . ",";
	$allTrialsGlobalData .= substr($headerItems[$key], 1, -1) . ",";
}
$localHeader = "";
// the header for individual-trial data
// we need to look inside one of the individual trials to find out what the variables are.
if (count($trialData) !== 0) {
    $parsedSampleTrialData = parseTrialData(array_values($trialData)[0]);
    foreach (array_keys($parsedSampleTrialData) as $key) {
    	$localHeader .= mb_substr($key, 1, -1) . ",";
    }
}
$header = $globalHeader . $localHeader;
$header = mb_substr($header, 0, -1) . "\n";


// convert the data into a comma-separated string
$data = "";
// this will be "Tidy Data": one line for each observation, with all global data stored for each trial

foreach (array_values($trialData) as $trialStr) {
	$data .= $allTrialsGlobalData; // start each trial's line with the subject-wise ('global') data
	$trialParsed = parseTrialData($trialStr);
    foreach (array_values($trialParsed) as $trialDataPoint) { 
		$data .= mb_substr($trialDataPoint, 1, -1) . ",";
	}
    $data = mb_substr($data, 0, -1) . "\n";
}

// remove the final newline, so that there aren't blank lines in the .csv
$data = mb_substr($data, 0, -1);

if (!file_exists($filename)) {
// for new files, add the header showing variable names.
	$writetxt = $header . $data;
} else {
// otherwise, we'll just append the data to the existing file.
	$writetxt = $data;
}

// Write the (header if relevant, and) data to the file, creating a file if doesn't already exist
$file = file_put_contents($filename, $writetxt.PHP_EOL , FILE_APPEND);
?>

</body>
</html>
