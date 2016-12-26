<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Director;
use CoreBundle\Form\DirectorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DirectorRestController extends Controller
{
    public function getDirectorAction($id){
        $director = $this->getDoctrine()->getRepository('CoreBundle:Director')->findOneById($id);
        if(!is_object($director)){
            throw $this->createNotFoundException();
        }
        return $director;
    }

    public function getDirectorsAction(){
        return $this->getDoctrine()->getRepository('CoreBundle:Director')->findAll();
    }

    public function postDirectorsAction(Request $request){
        $director = new Director();
        $form = $this->createForm(DirectorType::class, $director);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($director);
            $em->flush();
            return $director;
        } else {
            return $form;
        }
    }

    public function putDirectorAction(Request $request, $id){
        $director = $this->getDoctrine()->getRepository('CoreBundle:Director')->findOneById($id);
        if(!is_object($director)){
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(DirectorType::class, $director);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($director);
            $em->flush();
            return $director;
        } else {
            return $form;
        }
    }

    public function deleteDirectorAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $director = $em->getRepository('CoreBundle:Director')->findOneById($id);
        if(is_object($director)){
            $em->remove($director);
            $em->flush();
        }
    }
}
