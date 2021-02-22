<?php

declare(strict_types=1);

namespace Recruitment\Cart;

use OutOfBoundsException;
use Recruitment\Entity\ProductInterface;
use Recruitment\Entity\Order;

class Cart
{


    private $items = [];

    /**
     * @param ProductInterface $product
     * @param int $quantity
     * @return $this
     * @throws Exception\QuantityTooLowException
     */
    public function addProduct(ProductInterface $product, int $quantity = 1): self
    {
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                $item->incrementQuantity($quantity);
                return $this;
            }
        }

        $this->items[] = new Item($product, $quantity);
        return $this;
    }

    public function removeProduct(ProductInterface $product): self
    {
        foreach ($this->items as $index => $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                array_splice($this->items, $index, 1);
            }
        }

        return $this;
    }

    /**
     * @param int $index
     * @return ItemInterface
     * @throws \OutOfBoundsException
     */
    public function getItem(int $index): ItemInterface
    {
        if (!key_exists($index, $this->items)) {
            throw new \OutOfBoundsException(sprintf("Pozycji o podanym indeksie- [%d] nie znaleziono w koszyku", $index));
        }
        return $this->items[$index];
    }

    /**
     * @param int $productId
     * @return ItemInterface
     * @throws \OutOfBoundsException
     */
    public function getItemByProductId(int $productId): ItemInterface
    {
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() === $productId) {
                return $item;
            }
        }
        throw new \OutOfBoundsException(sprintf("Produkt o podanym id [%d] nie znaleziono w koszyku", $productId));
    }

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ProductInterface $product
     * @param int $quantity
     * @return self
     * @throws Exception\QuantityTooLowException
     */
    public function setQuantity(ProductInterface $product, int $quantity): self
    {
        try {
            $item = $this->getItemByProductId($product->getId());
            $item->setQuantity($quantity);
        } catch (OutOfBoundsException $exception) {
            $this->addProduct($product, $quantity);
        }
        return $this;
    }

    /**
     * @param int $orderId
     * @return Order
     */
    public function checkout(int $orderId): Order
    {
        $order = new Order($orderId);
        $order->setItems($this->getItems())
            ->setTotalPrice($this->getTotalPrice())
            ->setTotalPriceGross($this->getTotalPriceGross());
        $this->items = [];
        return $order;
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }

    /**
     * @return int
     */
    public function getTotalPriceGross(): int
    {

        $total = 0;

        array_walk(
            $this->items,
            function (ItemInterface $item) use (&$total) {
                $pricePerItem = $item->getProduct()->getUnitPrice();
                $productTax = $item->getProduct()->getTaxAmount();
                $total += ($pricePerItem * $item->getQuantity()) * ($productTax + 1);
            }
        );
        return (int)$total;
    }
}
