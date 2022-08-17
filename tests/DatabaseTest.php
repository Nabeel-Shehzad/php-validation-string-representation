<?php
/**
 * Unit-test for the database.
 *
 * PHP Version 8
 *
 * @category UnitTests
 * @package  Tests
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
declare(strict_types = 1)
;
namespace App\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Tests database validation
 *
 * @property string _host
 * @property string _port
 * @property string _username
 * @property string _password
 * @property \MySQLi _connection
 * @property string _database
 * @category UnitTests
 * @package  App\Tests
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
class DatabaseTest extends TestCase
{
    /**
     * Set up data needed for every unit-test
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   void
     */
    public function setUp(): void
    {
        $this->_host = 'mysql-db';
        $this->_port = '3306';
        $this->_username = 'cs3620';
        $this->_password = 'letmein';
        $this->_connection = null;
        $this->_database = 'cs3620';
        $this->_connection = mysqli_connect(
            $this->_host,
            $this->_username,
            $this->_password
        );
        $this->_connection->select_db($this->_database);
    }

    /**
     * Tests if unit-test can be run
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   void
     */
    public function testCanary(): void
    {
        // arrange & act & assert
        $this->assertTrue(true);
    }

    /**
     * Tests SELECT ALL statement.
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   void
     */
    public function testSelectAll(): void
    {
        // arrange
        $query = "SELECT * FROM " . $this->_database . ".test";
        print($query);
        // act
        $result = $this->_connection->query($query);
        $row = $result->fetch_row();
        // assert
        $this->assertEquals('1', $row[0]);
    }
}
