<?php

use App\Helpers;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function testPushToPaymentsPerMonths()
    {
        $result = Helpers::pushToPaymentsPerMonths([], new \DateTime('2021-01-01'));

        $expected = ["Jan" => [
                "salary" => "2021-01-29",
                "bonus" => "2021-01-15"
            ]
        ];
        $this->assertEquals($expected, $result);
    }

    public function testGetSalaryPaymentDate()
    {
        $result = Helpers::getSalaryPaymentDate(new \DateTime('2021-01-01'));

        $this->assertEquals('2021-01-29', $result);
    }

    public function testGetBonusPaymentDate()
    {
        $result = Helpers::getBonusPaymentDate(new \DateTime('2021-01-01'));
       
        $this->assertEquals('2021-01-15', $result);
    }

}