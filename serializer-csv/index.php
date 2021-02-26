<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Fruit;
use App\Entity\Basket;
use App\Entity\Customer;
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