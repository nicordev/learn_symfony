<?php

namespace App\Dto;

use App\Entity\Customer;
use App\Dto\CustomerBasketDto;
use App\Entity\Basket;
use App\Entity\Fruit;

class CustomerBasketConverter
{
    public function convertDtoToEntities(CustomerBasketDto $customerBasketDto)
    {
        $customer = (new Customer())
            ->setFirstName($customerBasketDto->getFirstName())
            ->setLastName($customerBasketDto->getLastName())
            ->setEmail($customerBasketDto->getEmail())
        ;
        $basket = (new Basket);
        $fruits = array_map(function (string $fruitName) use ($basket) {
            $fruit = (new Fruit())->setName($fruitName);
            $basket->addFruit($fruit);

            return $fruit;
        }, explode(', ', $customerBasketDto->getFruits()));

        return [
            'customer' => $customer,
            'basket' => $basket,
            'fruits' => $fruits
        ]
    }
}