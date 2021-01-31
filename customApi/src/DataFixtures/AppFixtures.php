<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $students = [
            [
                "firstName" => "Sarah",
                "lastName" => "Croche"
            ],[
                "firstName" => "Jim",
                "lastName" => "Nastique"
            ],[
                "firstName" => "Jean",
                "lastName" => "Saisrien"
            ]
        ];

        foreach ($students as $student) {
            $manager->persist($this->createStudent($student));
        }

        $manager->flush();
    }

    private function createStudent($studentData): Student
    {
        return (new Student())
            ->setFirstName($studentData['firstName'])
            ->setLastName($studentData['lastName'])
        ;
    }
}
