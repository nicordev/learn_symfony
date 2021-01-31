<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentTest extends WebTestCase
{
    /**
     * In order to see the list of Student
     * As a User
     * I need to fetch all students
     */
    public function testGetCollection() {
        $client = static::createClient();

        $client->request('GET', '/students');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}