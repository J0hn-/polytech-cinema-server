<?php

namespace CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GenreRestControllerTest extends WebTestCase
{

    public function testGenres()
    {
        $client = static::createClient();
        $client->request('GET', '/genres');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreate(){
        $client = static::createClient();

        $client->request('POST', '/genres', array(
            'title' => 'P0rn'
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        return json_decode($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $genre
     */
    public function testRead($genre) {
        $client = static::createClient();
        $client->request('GET', '/genres/'.$genre->id);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals($genre, json_decode($client->getResponse()->getContent()));
    }

    /**
     * @depends testCreate
     * @param $genre
     */
    public function testModify($genre) {
        $client = static::createClient();
        $client->request('PUT', '/genres/'.$genre->id, array(
            'title' => 'P0rn xXx'
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $genre
     */
    public function testDelete($genre) {
        $client = static::createClient();
        $client->request('DELETE', '/genres/'.$genre->id);
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

}
