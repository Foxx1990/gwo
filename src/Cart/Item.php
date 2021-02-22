<?php


namespace Recruitment\Cart;

use InvalidArgumentException;
use Recruitment\Cart\Exception\QuantityTooLowException;
use Recruitment\Entity\ProductInterface;

class Item implements ItemInterface
{

    /** @var ProductInterface */
    private $product;
    /** @var int */
    private $quantity;

    /**
     * Item constructor.
     * @param ProductInterface $product
     * @param int $quantity
     * @throws QuantityTooLowException
     */
    public function __construct(ProductInterface $product, int $quantity)
    {
        $this->setProduct($product);

        if($quantity < $this->product->getMinimumQuantity()){
            throw new InvalidArgumentException(sprintf(
                "Podana ilość [%d] jest mniejsza niż minimalna ilość zadeklarowana dla produktu [%d]",
                $quantity,
                $product->getMinimumQuantity()
            ));
        }
        $this->setQuantity($quantity);
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     * @return self
     */
    public function setProduct(ProductInterface $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @throws QuantityTooLowException
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        if($quantity < 1 || $quantity < $this->product->getMinimumQuantity()){
            throw new QuantityTooLowException("Ilość pozycji można ustawić tylko na liczbę dodatnią.");
        }
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @param int $quantity
     * @return self
     */
    public function incrementQuantity(int $quantity): self
    {
        if($quantity < 1){
            throw new InvalidArgumentException("Możesz zwiększyć ilość towaru tylko o nieujemną kwotę.");
        }
        $this->quantity += $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->getProduct()->getUnitPrice() * $this->getQuantity();
    }

    /**
     * @return int
     */
    public function getTotalPriceGross(): int
    {
        return $this->getProduct()->getUnitPrice() * $this->getQuantity() * ($this->getProduct()->getTaxAmount() + 1);
    }
}
