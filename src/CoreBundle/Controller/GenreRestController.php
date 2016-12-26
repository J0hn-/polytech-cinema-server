<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Genre;
use CoreBundle\Form\GenreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GenreRestController extends Controller
{
    public function getGenreAction($id){
        $genre = $this->getDoctrine()->getRepository('CoreBundle:Genre')->findOneById($id);
        if(!is_object($genre)){
            throw $this->createNotFoundException();
        }
        return $genre;
    }

    public function getGenresAction(){
        return $this->getDoctrine()->getRepository('CoreBundle:Genre')->findAll();
    }

    public function postGenresAction(Request $request){
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($genre);
            $em->flush();
            return $genre;
        } else {
            return $form;
        }
    }

    public function putGenreAction(Request $request, $id){
        $genre = $this->getDoctrine()->getRepository('CoreBundle:Genre')->findOneById($id);
        if(!is_object($genre)){
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(GenreType::class, $genre);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($genre);
            $em->flush();
            return $genre;
        } else {
            return $form;
        }
    }

    public function deleteGenreAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $genre = $em->getRepository('CoreBundle:Genre')->findOneById($id);
        if(is_object($genre)){
            $em->remove($genre);
            $em->flush();
        }
    }
}
