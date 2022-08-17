<?php
/**
 * Validation.php
 *
 * PHP Version 8
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
namespace App;

use SplStack;

$host = 'mysql-db';//mysql-db
$dbname = 'cs3620';
$user = 'cs3620';//cs3620
$pass = 'letmein';//letmein

// TODO write code that validates the  data variables passed in on http://localhost/Validation.php?col_string=Two&col_number=2

// $_GET is a PHP super-global read more about super-globals here:
// https://secure.php.net/manual/en/language.variables.superglobals.php

print("Homework 09 - Data Validation</br>");
//var_dump($_GET);
print("</br>");

if(isset($_GET['col_string']) || isset($_GET['col_number'])){
    if ((wordsToNumber($_GET['col_string']) != 0) && is_numeric($_GET['col_number'])) {
        print("<p>The data is valid</p>");
    } else {
        print("<p>The data is invalid</p>");
    }
    mysqli_connect($host, $user, $pass, $dbname) or die("Connection failed: " . mysqli_connect_error());
    echo "All done...<br>";
}
else{
    echo "No data was passed in...";
}
print("col_string=" . $_GET['col_string'] . "</br>");
print("col_number=" . $_GET['col_number'] . "</br>");

function wordsToNumber($data) {
    // Replace all number words with an equivalent numeric value
    $data = strtr(
        $data,
        array(
            'zero'      => '0',
            'a'         => '1',
            'one'       => '1',
            'two'       => '2',
            'three'     => '3',
            'four'      => '4',
            'five'      => '5',
            'six'       => '6',
            'seven'     => '7',
            'eight'     => '8',
            'nine'      => '9',
            'ten'       => '10',
            'eleven'    => '11',
            'twelve'    => '12',
            'thirteen'  => '13',
            'fourteen'  => '14',
            'fifteen'   => '15',
            'sixteen'   => '16',
            'seventeen' => '17',
            'eighteen'  => '18',
            'nineteen'  => '19',
            'twenty'    => '20',
            'thirty'    => '30',
            'forty'     => '40',
            'fourty'    => '40', // common misspelling
            'fifty'     => '50',
            'sixty'     => '60',
            'seventy'   => '70',
            'eighty'    => '80',
            'ninety'    => '90',
            'hundred'   => '100',
            'thousand'  => '1000',
            'million'   => '1000000',
            'billion'   => '1000000000',
            'and'       => '',
        )
    );

    // Coerce all tokens to numbers
    $parts = array_map(
        function ($val) {
            return floatval($val);
        },
        preg_split('/[\s-]+/', $data)
    );

    $stack = new SplStack; // Current work stack
    $sum   = 0; // Running total
    $last  = null;

    foreach ($parts as $part) {
        if (!$stack->isEmpty()) {
            // We're part way through a phrase
            if ($stack->top() > $part) {
                // Decreasing step, e.g. from hundreds to ones
                if ($last >= 1000) {
                    // If we drop from more than 1000 then we've finished the phrase
                    $sum += $stack->pop();
                    // This is the first element of a new phrase
                    $stack->push($part);
                } else {
                    // Drop down from less than 1000, just addition
                    // e.g. "seventy one" -> "70 1" -> "70 + 1"
                    $stack->push($stack->pop() + $part);
                }
            } else {
                // Increasing step, e.g ones to hundreds
                $stack->push($stack->pop() * $part);
            }
        } else {
            // This is the first element of a new phrase
            $stack->push($part);
        }

        // Store the last processed part
        $last = $part;
    }

    return $sum + $stack->pop();
}
