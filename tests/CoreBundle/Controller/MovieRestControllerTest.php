<?php

namespace CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieRestControllerTest extends WebTestCase
{

    public function testMovies()
    {
        $client = static::createClient();
        $client->request('GET', '/movies');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreate(){
        $client = static::createClient();

        $client->request('POST', '/movies', array(
            'duration' => '42',
            'releaseDate'  => '1994-12-25T00:00:00+0000',
            'title' => 'OMG',
            'director' => null,
            'genre' => null
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        return json_decode($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $movie
     */
    public function testRead($movie) {
        $client = static::createClient();
        $client->request('GET', '/movies/'.$movie->id);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals($movie, json_decode($client->getResponse()->getContent()));
    }

    /**
     * @depends testCreate
     * @param $movie
     */
    public function testModify($movie) {
        $client = static::createClient();
        $client->request('PUT', '/movies/'.$movie->id, array(
            'duration' => '42',
            'releaseDate'  => '1994-12-25T00:00:00+0000',
            'title' => 'OMG!!!!',
            'director' => null,
            'genre' => null
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $movie
     */
    public function testDelete($movie) {
        $client = static::createClient();
        $client->request('DELETE', '/movies/'.$movie->id);
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }
}
