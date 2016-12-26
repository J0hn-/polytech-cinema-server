<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Movie;
use CoreBundle\Form\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MovieRestController extends Controller
{
    public function getMovieAction($id){
        $movie = $this->getDoctrine()->getRepository('CoreBundle:Movie')->findOneById($id);
        if(!is_object($movie)){
            throw $this->createNotFoundException();
        }
        return $movie;
    }

    public function getMoviesAction(){
        return $this->getDoctrine()->getRepository('CoreBundle:Movie')->findAll();
    }

    public function postMoviesAction(Request $request){
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($movie);
            $em->flush();
            return $movie;
        } else {
            return $form;
        }
    }

    public function putMovieAction(Request $request, $id){
        $movie = $this->getDoctrine()->getRepository('CoreBundle:Movie')->findOneById($id);
        if(!is_object($movie)){
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(MovieType::class, $movie);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($movie);
            $em->flush();
            return $movie;
        } else {
            return $form;
        }
    }

    public function deleteMovieAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $movie = $em->getRepository('CoreBundle:Movie')->findOneById($id);
        if(is_object($movie)){
            $em->remove($movie);
            $em->flush();
        }
    }
}
