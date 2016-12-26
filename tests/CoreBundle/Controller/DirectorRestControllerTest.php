<?php

namespace CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DirectorRestControllerTest extends WebTestCase
{
    public function testDirectors()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/directors');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCRUD()
    {
        $client = static::createClient();

        $client->request('POST', '/directors', array(
            'firstName' => 'John',
            'lastName'  => 'Snow'
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $director = json_decode($client->getResponse()->getContent());

        // READ
        $client->request('GET', '/directors/'.$director->id);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals($director, json_decode($client->getResponse()->getContent()));

        // MODIFY
        $client->request('PUT', '/directors/'.$director->id, array(
            'firstName' => 'John',
            'lastName'  => 'Stark'
        ));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        // DELETE
        $client->request('DELETE', '/directors/'.$director->id);
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

}
