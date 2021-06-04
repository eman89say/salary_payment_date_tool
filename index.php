<?php 

require_once('app/bootstrap.php');

use App\CSVCreator;
use App\Helpers;

// get outputfileName from second argument passed to the script
$outputFile = $argv[1];

// get year from the third argument passed to the script 
// or choose current year if no argument passed
$thisYear = (new \DateTime('NOW'))->format('Y');
$year = $argv[2] ?? $thisYear;
$date = new \DateTime($year . '-01-01');

$paymentsPerMonths = [];
// Push first Month to the list
$paymentsPerMonths = Helpers::pushToPaymentsPerMonths($paymentsPerMonths, $date);

// Push the rest of the months to the list
for ($i=1; $i <= 11; $i++) {
    $copy = clone $date;
    $newMonth = $copy->modify("+{$i} month");

    $paymentsPerMonths = Helpers::pushToPaymentsPerMonths($paymentsPerMonths, $copy);
}

// create CSV using the output file and paymentsPerMonths Array
$dirName = "outputCSV";
is_dir($dirName) || mkdir($dirName, '0777', true);
$fileName =  "{$dirName}/{$outputFile}_{$year}.csv";
$csvCreator = new CSVCreator($paymentsPerMonths, $fileName);
$csvCreator->createCSV();
