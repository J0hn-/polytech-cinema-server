<?php

namespace CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActorRestControllerTest extends WebTestCase
{

    public function testActors()
    {
        $client = static::createClient();
        $client->request('GET', '/actors');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreate(){
        $client = static::createClient();

        $client->request('POST', '/actors', array(
            'first_name' => 'John',
            'last_name'  => 'Snow',
            'birthday'  => '1994-12-25T00:00:00+0000',
            'deathday'  => ''
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        return json_decode($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $actor
     */
    public function testRead($actor) {
        $client = static::createClient();
        $client->request('GET', '/actors/'.$actor->id);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        //$this->assertEquals($actor, json_decode($client->getResponse()->getContent()));
    }

    /**
     * @depends testCreate
     * @param $actor
     */
    public function testModify($actor) {
        $client = static::createClient();
        $client->request('PUT', '/actors/'.$actor->id, array(
            'first_name' => 'John',
            'last_name'  => 'Stark',
            'birthday'  => '1994-12-25T00:00:00+0000',
            'deathday'  => '2016-12-25T00:00:00+0000'
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    /**
     * @depends testCreate
     * @param $actor
     */
    public function testDelete($actor) {
        $client = static::createClient();
        $client->request('DELETE', '/actors/'.$actor->id);
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

}
