<!DOCTYPE html>
<html>
<body>

<h1>Thanks for participating!</h1>

Please do <b>not</b> reload or use your browser's &quot;back&quot; button. Instead, close the current tab. 

<?php
// make a directory to store experimental data, if it doesn't already exist
if (!file_exists('experimentData/')) {
    mkdir('experimentData/', 0777, true);
}
// pick filename from posted value of experimentName variable
$filename = "experimentData/" . substr($_POST["experimentName"], 1, -1) . "-experiment.csv";

// Open the file to get existing content
$data = "";
if (!file_exists($filename)) {
// for new files, make header showing variable names
	foreach (array_keys($_POST) as $key) {
		$data .= $key . ",";
	}
	$data = substr($data, 0, -1) . "\n";
}
// convert the data into a comma-separated string
//foreach ($_POST as $val) {
foreach (array_keys($_POST) as $key) {
   $data .= $_POST[$key] . ",";
}
// Write the $current variable to the file, creating one if doesn't already exist
$file = file_put_contents($filename, $data.PHP_EOL , FILE_APPEND);
?>

</body>
</html>