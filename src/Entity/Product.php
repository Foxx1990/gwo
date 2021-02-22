<?php

namespace Recruitment\Entity;

use InvalidArgumentException;
use Recruitment\Entity\Exception\InvalidUnitPriceException;

class Product implements ProductInterface
{

    private const ALLOWED_TAXES = [0, 0.05, 0.08, 0.23];

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var float */
    private $price;

    /** @var float */
    private $taxAmount = 0;

    /** @var int */
    private $minimumQuantity = 1;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    /**
     * @param float $taxAmount
     * @return self
     */
    public function setTaxAmount(float $taxAmount): self
    {
        if(!in_array($taxAmount,self::ALLOWED_TAXES)){
            throw new InvalidArgumentException(sprintf(
                    "Podana kwota podatku [%f] powinna być jedną z dozwolonych wartości (%s).",
                    $taxAmount,
                    implode(',',self::ALLOWED_TAXES)
            ));
        }

        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinimumQuantity(): int
    {
        return $this->minimumQuantity;
    }

    /**
     * @param int $minimumQuantity
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setMinimumQuantity(int $minimumQuantity): self
    {
        if($minimumQuantity < 1){
            throw new \InvalidArgumentException(sprintf("Minimalna ilość produktu powinna wynosić 1",$minimumQuantity));
        }
        $this->minimumQuantity = $minimumQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getGrossUnitPrice(): int
    {
        return $this->price * ($this->taxAmount + 1);
    }

    /**
     * @param int $price
     * @return $this
     * @throws InvalidUnitPriceException
     */
    public function setUnitPrice(int $price): self
    {
        if($price <= 0){
            throw new InvalidUnitPriceException(sprintf("Podana cena jednostkowa powinna być więlsza od 0.",$price));
        }
        $this->price = $price;
        return $this;
    }
}
