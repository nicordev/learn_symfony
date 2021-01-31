<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{
    /**
     * In order to see the list of Student
     * As a User
     * I need to fetch all students
     */
    public function testGetCollection() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/students');
        $response = $client->getResponse();

        self::assertEquals(200, $response->getStatusCode());
        $responseContent = $response->getContent();
        $data = json_decode($responseContent);
        dd($data);
    }
}