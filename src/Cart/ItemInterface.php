<?php


namespace Recruitment\Cart;


use Recruitment\Entity\ProductInterface;

interface ItemInterface
{    
    /**
     * getProduct
     *
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface;
        
    /**
     * setProduct
     *
     * @param  mixed $product
     * @return void
     */
    public function setProduct(ProductInterface $product);
        
    /**
     * getQuantity
     *
     * @return int
     */
    public function getQuantity(): int;
        
    /**
     * setQuantity
     *
     * @param  mixed $quantity
     * @return void
     */
    public function setQuantity(int $quantity);
        
    /**
     * getTotalPrice
     *
     * @return int
     */
    public function getTotalPrice(): int;
    
    /**
     * getTotalPriceGross
     *
     * @return int
     */
    public function getTotalPriceGross(): int;    
    /**
     * incrementQuantity
     *
     * @param  mixed $quantity
     * @return void
     */
    public function incrementQuantity(int $quantity);
}
