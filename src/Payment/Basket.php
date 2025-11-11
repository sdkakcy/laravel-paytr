<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr\Payment;

class Basket
{
    private array $products = [];

    public function addProduct(Product $product, int $quantity): static
    {
        $this->products[] = [
            $product->getName(),
            $product->getPrice(),
            $quantity,
        ];

        return $this;
    }

    /**
     * @var array<int, array{0: string, 1: float, 2: int}>
     */
    public function addProducts(array $basketProducts): static
    {
        $this->products = array_merge($this->products, $basketProducts);

        return $this;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function formatted(): string
    {
        return base64_encode(json_encode($this->products));
    }
}
