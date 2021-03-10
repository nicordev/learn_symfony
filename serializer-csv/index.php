<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Fruit;
use App\Entity\Basket;
use App\Entity\Customer;
use App\Dto\CustomerBasketDto;
use App\Dto\CustomerBasketConverter;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

echo "Try Symfony serializer component for CSV files\n";

$encoders = [new CsvEncoder()];
$normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];

$serializer = new Serializer($normalizers, $encoders);

$customerCsv = file_get_contents(__DIR__.'/data/customers.csv');

$customers = $serializer->deserialize($customerCsv, Customer::class.'[]', 'csv');

var_dump($customers);

// Need to have getter and setter to deserialize
$customerBaskets = $serializer->deserialize($customerCsv, CustomerBasketDto::class.'[]', 'csv');

var_dump($customerBaskets);

$customerBasketConverter = new CustomerBasketConverter();

foreach ($customerBaskets as $customerBasket) {
    var_dump($customerBasketConverter->convertDtoToEntities($customerBasket));
}