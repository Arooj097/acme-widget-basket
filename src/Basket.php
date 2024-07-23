<?php

namespace Acme;

class Basket
{
    private $products;
    private $deliveryRules;
    private $offers;
    private $items = [];

    public function __construct(array $products, array $deliveryRules, array $offers)
    {
        $this->products = $products;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add(string $productCode)
    {
        if (!isset($this->products[$productCode])) {
            throw new \InvalidArgumentException("Product code '$productCode' does not exist.");
        }
        $this->items[] = $productCode;
    }

    public function total(): float
    {
        $total = 0.0;
        $itemCounts = array_count_values($this->items);

        // Calculate total without delivery
        foreach ($itemCounts as $code => $count) {
            if (!isset($this->products[$code])) {
                continue;
            }

            $total += $this->products[$code]['price'] * $count;
            
            // Apply special offers
            if (isset($this->offers[$code])) {
                $offer = $this->offers[$code];
                if ($offer['buy'] > 0) {
                    $discountedItems = floor($count / ($offer['buy'] + 1));
                    $total -= $discountedItems * $this->products[$code]['price'] * $offer['get'];
                }
            }
        }

        // Apply delivery rules
        $total += $this->calculateDeliveryCost($total);

        return $total;
    }

    private function calculateDeliveryCost(float $total): float
    {
        foreach ($this->deliveryRules as $rule) {
            if ($total < $rule['limit']) {
                return $rule['cost'];
            }
        }
        return 0.0;
    }
}
?>
