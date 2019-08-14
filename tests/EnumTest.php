<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class EnumTest extends TestCase
{
    public function testCreateEnumByConstructor()
    {
        $status = new CommentStatus(1);
        $country = new Country('ir');

        $this->assertTrue($status instanceof CommentStatus);
        $this->assertTrue($country instanceof Country);
    }

    public function testCreateEnumFromStudlyCasedKey()
    {
        $status = CommentStatus::approved();
        $country = Country::iran();

        $this->assertTrue($status instanceof CommentStatus);
        $this->assertTrue($country instanceof Country);
    }

    public function testKeyAndValue()
    {
        $status = CommentStatus::approved();
        $this->assertEquals('APPROVED', $status->key());
        $this->assertEquals(1, $status->value());

        $country = Country::turkey();
        $this->assertEquals('tr', $country->value());
        $this->assertEquals('TURKEY', $country->key());
    }

    public function testIsMethod()
    {
        $country = Country::iran();
        $this->assertTrue($country->isIran());
        $this->assertFalse($country->isTurkey());
    }
}
