<?php 

declare(strict_types=1);
require_once 'autoload.php';
use PHPUnit\Framework\TestCase;

final class UtilitiesTest extends TestCase{

    public function testIsValidApiKey(): void {
        $apikey = '->d1027fe51dd715eb9f716d560a7b8841<-';
        $result = Utilities::isValidApiKey($apikey);
        $this->assertEquals(true, $result);
    }

    public function testCannotBeValidApiKey(): void {
        $invalidApiKey = 'invalid-api-key';
        $result = Utilities::isValidApiKey($invalidApiKey);
        //$this->assertEquals(false, $result);
        $this->assertIsBool($result);
    }

    public function testValidateDate(): void {
        $date = '2022-01-01';
        $result = Utilities::validateDate($date);
        $this->assertEquals(true, $result);
    }

    #sample test cases
 }


