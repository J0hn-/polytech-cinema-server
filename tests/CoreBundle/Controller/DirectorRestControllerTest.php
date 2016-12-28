<?php

namespace CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DirectorRestControllerTest extends WebTestCase
{

    public function testDirectors()
    {
        $client = static::createClient();
        $client->request('GET', '/directors');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreate(){
        $client = static::createClient();

        $client->request('POST', '/directors', array(
            'first_name' => 'John',
            'last_name'  => 'Snow'
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        return json_decode($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $director
     */
    public function testRead($director) {
        $client = static::createClient();
        $client->request('GET', '/directors/'.$director->id);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals($director, json_decode($client->getResponse()->getContent()));
    }

    /**
     * @depends testCreate
     * @param $director
     */
    public function testModify($director) {
        $client = static::createClient();
        $client->request('PUT', '/directors/'.$director->id, array(
            'first_name' => 'John',
            'last_name'  => 'Stark'
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $director
     */
    public function testDelete($director) {
        $client = static::createClient();
        $client->request('DELETE', '/directors/'.$director->id);
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

}
