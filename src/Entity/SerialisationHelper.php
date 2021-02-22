<?php


namespace Recruitment\Entity;


use Recruitment\Cart\ItemInterface;


class SerialisationHelper
{
    public static function serialiseItems(array $items): array
    {
        $serialisedItemArray= [];
        /** @var ItemInterface $item */
        foreach ($items as $item) {
            $serialisedItemArray[] = [
                "id" => $item->getProduct()->getId(),
                "quantity" => $item->getQuantity(),
                "total_price" => $item->getTotalPrice(),
                "total_price_gross" => $item->getTotalPriceGross(),
            ];
        }
        return $serialisedItemArray;
    }

    public static function getSerialisedOrderData(OrderInterface $order): array
    { 
        return [
            "id" => $order->getId(),
            "items" => self::serialiseItems($order->getItems()),
            "total_price" => $order->getTotalPrice(),
            "total_price_gross" => $order->getTotalPriceGross()
        ];
    }
}
