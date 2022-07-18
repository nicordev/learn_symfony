<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Fruit;
use App\Entity\Basket;
use App\Entity\Customer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

function trySerialization() {
    echo "Try Symfony serializer component\n";

    $encoders = [new XmlEncoder()];
    $normalizers = [new ObjectNormalizer()];

    $serializer = new Serializer($normalizers, $encoders);

    $fruit = (new Fruit())
        ->setName('apple')
        ->setCount(15)
    ;

    $xmlContent = $serializer->serialize($fruit, 'xml');

    echo "A Fruit:\n$xmlContent\n\n";

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

    $xmlContent = $serializer->serialize($basket, 'xml');

    echo "A Basket full of Fruits:\n$xmlContent\n\n";

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
    $xmlContent = $serializer->serialize($data, 'xml');

    echo "A customer using normalize then serialize (total control over serialization):\n$xmlContent\n\n";

    $xmlContent = $serializer->serialize(
        $customer,
        'xml',
        [
            AbstractNormalizer::IGNORED_ATTRIBUTES => [
                'password',
                'fruits' => [
                    'count'
                ]
            ]
        ]
    );

    echo "A customer using only serialize (can ignore only top properties):\n$xmlContent\n";
}

//
// Deserialization
//

function tryDeserialization() {
    $encoders = [new XmlEncoder()];
    $normalizers = [new ObjectNormalizer(null, null, null, new ReflectionExtractor())];
    $serializer = new Serializer($normalizers, $encoders);

    $customerXml = file_get_contents(__DIR__.'/data/customer.xml');
    $customer = $serializer->deserialize(
        $customerXml,
        Customer::class,
        'xml',
        [
            ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => false
        ]
    );

    var_dump($customer);
}

// trySerialization();

tryDeserialization();