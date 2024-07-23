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
        if (isset($this->products[$productCode])) {
            $this->items[] = $productCode;
        }
    }

    public function total(): float
    {
        $total = 0.0;
        $itemCounts = array_count_values($this->items);

        // Calculate total without delivery
        foreach ($itemCounts as $code => $count) {
            $total += $this->products[$code]['price'] * $count;
            // Apply special offers
            if ($code == 'R01' && $count > 1) {
                $total -= ($this->products[$code]['price'] / 2);
            }
        }

        // Apply delivery rules
        if ($total < 50) {
            $total += 4.95;
        } elseif ($total < 90) {
            $total += 2.95;
        }

        return $total;
    }
}
?>