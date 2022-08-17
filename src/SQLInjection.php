<?php
/**
 * SQLInjection.php
 *
 * PHP Version 8
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
declare(strict_types=1)
;

namespace App;

$host = 'mysql-db';//mysql-db
$dbname = 'cs3620';
$user = 'cs3620';//cs3620
$pass = 'letmein';//letmein
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

print("Homework 09 - SQL Injection</br>");
var_dump($_GET);
print("</br>");

// URL with SQL injection: http://localhost/SQLInjection.php?col_string=%27Two%27+OR+1=1--&col_number=2

// TODO change this below code to prevent SQL Injection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = mysqli_connect($host, $user, $pass, $dbname);
$conn->set_charset($charset);

$query = $conn->prepare( "SELECT * FROM test WHERE col_string = ? AND col_number = ?");

$query->bind_param("si", $_GET['col_string'], $_GET['col_number']);
$query->execute();

$result = $query->get_result();

if (is_bool($result)) {
    throw new \RuntimeException('ERROR: result is a boolean and NOT a result set');
}
$num_row = mysqli_num_rows($result);

print('Retrieved ' . $num_row . ' row(s)</br></br>');

while ($row = $result->fetch_assoc()) {
    printf('<li>%s, %s, %s, %s, %s</li></br>', $row[0], $row[1], $row[2], $row[3], $row[4]);
}

mysqli_free_result($result);
mysqli_close($conn);

echo "All done...";
