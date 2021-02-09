<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Fruit;
use App\Entity\Basket;
use App\Entity\Customer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

echo "Try Symfony serializer component\n";

$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

$fruit = (new Fruit())
    ->setName('apple')
    ->setCount(15)
;

$jsonContent = $serializer->serialize($fruit, 'json');

echo "A Fruit:\n$jsonContent\n\n";

$basket = new Basket();
$fruits = [
    $fruit,
    (new Fruit())
        ->setName('raspberry')
        ->setCount(10),
    (new Fruit())
        ->setName('cherry')
        ->setCount(20),
    (new Fruit())
        ->setName('peach')
        ->setCount(30),
];

$basket->setFruits($fruits);

$jsonContent = $serializer->serialize($basket, 'json');

echo "A Basket full of Fruits:\n$jsonContent\n\n";

// Complete control over serialization:
$customer = (new Customer)->setFirstName('sarah')
    ->setLastName('croche')
    ->setEmail('sarah@croche.com')
    ->setPassword('strongPassword')
    ->setBasket($basket)
;

$data = $serializer->normalize(
    $customer,
    null,
    [
        AbstractNormalizer::ATTRIBUTES => [
            'firstName',
            'lastName',
            'email',
            'basket' => [
                'itemCount',
                'fruits' => [
                    'name'
                ]
            ]
        ]
    ]
);
$jsonContent = $serializer->serialize($data, 'json');

echo "A customer using normalize then serialize (total control over serialization):\n$jsonContent\n\n";

$jsonContent = $serializer->serialize(
    $customer,
    'json',
    [
        AbstractNormalizer::IGNORED_ATTRIBUTES => [
            'password',
            'fruits' => [
                'count'
            ]
        ]
    ]
);

echo "A customer using only serialize (can ignore only top properties):\n$jsonContent\n";