<?php

use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testVAT1Calculation()
    {
        $this->assertEquals(
            5.265,
            DemoArticle::validVAT1(4.5)
        );
    }
    
    public function testVAT2Calculation()
    {
        $this->assertEquals(
            4.635,
            DemoArticle::validVAT2(4.5)
        );
    }
    
    public function testNotValidVAT1Calculation() {
        $this->assertNotEquals(
            4,
            DemoArticle::validVAT1(4.5)
        );
    }
    
    public function testNotValidVAT2Calculation() {
        $this->assertNotEquals(
            4,
            DemoArticle::validVAT2(4.5)
        );
    }
}