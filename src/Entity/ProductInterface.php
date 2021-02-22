<?php

namespace Recruitment\Entity;

interface ProductInterface
{

    /**
     * @return int
     */
    public function getId(): ?int;

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return self
     */
    public function  setName(string $name);

    /**
     * @return float
     */
    public function getUnitPrice(): int;

    /**
     * @param int $price
     * @return self
     */
    public function setUnitPrice(int $price);

    /**
     * @return float
     */
    public function getTaxAmount(): float;

    /**
     * @param float $taxAmount
     * @return self
     */
    public function setTaxAmount(float $taxAmount);

    /**
     * @return int
     */
    public function getMinimumQuantity(): int;

    /**
     * @param int $minimumQuantity
     * @return self
     */
    public function setMinimumQuantity(int $minimumQuantity);
}
