<?php

use PHPUnit\Framework\TestCase;
use Acme\Basket;

class BasketTest extends TestCase
{
    private $products;
    private $deliveryRules;
    private $offers;

    protected function setUp(): void
    {
        $this->products = [
            'R01' => ['name' => 'Red Widget', 'price' => 32.95],
            'G01' => ['name' => 'Green Widget', 'price' => 24.95],
            'B01' => ['name' => 'Blue Widget', 'price' => 7.95]
        ];

        $this->deliveryRules = [
            ['limit' => 50, 'cost' => 4.95],
            ['limit' => 90, 'cost' => 2.95],
            ['limit' => PHP_INT_MAX, 'cost' => 0]
        ];

        $this->offers = [
            'R01' => ['buy' => 1, 'get' => 0.5]
        ];
    }

    public function testBasketTotals()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);

        $basket->add('B01');
        $basket->add('G01');
        $this->assertEqualsWithDelta(37.85, $basket->total(), 0.01);

        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEqualsWithDelta(54.37, $basket->total(), 0.01);

        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEqualsWithDelta(60.85, $basket->total(), 0.01);

        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEqualsWithDelta(98.27, $basket->total(), 0.01);
    }
}
?>