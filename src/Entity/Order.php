<?php

namespace Recruitment\Entity;

use Recruitment\Cart\ItemInterface;

class Order implements OrderInterface
{

    /** @var int */
    private $id;

    /** @var ItemInterface[] */
    private $items;

    /** @var int */
    private $totalPrice;

    /** @var int */
    private $totalPriceGross;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ItemInterface[] $items
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     * @return self
     */
    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPriceGross(): int
    {
        return $this->totalPriceGross;
    }

    /**
     * @param int $totalPriceGross
     * @return self
     */
    public function setTotalPriceGross(int $totalPriceGross): self
    {
        $this->totalPriceGross = $totalPriceGross;
        return $this;
    }

    public function getDataForView(): array
    {
        return SerialisationHelper::getSerialisedOrderData($this);
    }
}