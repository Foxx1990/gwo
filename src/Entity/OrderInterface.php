<?php

namespace Recruitment\Entity;

interface OrderInterface
{
        
    /**
     * getId
     *
     * @return int
     */
    public function getId():int;
        
    /**
     * getItems
     *
     * @return array
     */
    public function getItems():array;    
    /**
     * setItems
     *
     * @param  mixed $items
     * @return self
     */
    public function setItems(array $items):self;    
    /**
     * getTotalPrice
     *
     * @return int
     */
    public function getTotalPrice():int;
        
    /**
     * setTotalPrice
     *
     * @param  mixed $totalPrice
     * @return self
     */
    public function setTotalPrice(int $totalPrice):self;
        
    /**
     * getTotalPriceGross
     *
     * @return int
     */
    public function getTotalPriceGross(): int;
        
    /**
     * setTotalPriceGross
     *
     * @param  mixed $totalPriceGross
     * @return self
     */
    public function setTotalPriceGross(int $totalPriceGross): self;
        
    /**
     * getDataForView
     *
     * @return array
     */
    public function getDataForView(): array;
}
