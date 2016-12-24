<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Movie;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class MovieController extends FOSRestController
{
    /**
     * @Route("/lol")
     */
    public function defaultAction()
    {
        $movies = $this->getDoctrine()->getManager()->getRepository(Movie::class)->findAll();
        return $this->json($movies);
    }


}
