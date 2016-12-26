<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Actor;
use CoreBundle\Form\ActorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActorRestController extends Controller
{
    public function getActorAction($id){
        $actor = $this->getDoctrine()->getRepository('CoreBundle:Actor')->findOneById($id);
        if(!is_object($actor)){
            throw $this->createNotFoundException();
        }
        return $actor;
    }

    public function getActorsAction(){
        return $this->getDoctrine()->getRepository('CoreBundle:Actor')->findAll();
    }

    public function postActorsAction(Request $request){
        $actor = new Actor();
        $form = $this->createForm(ActorType::class, $actor);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($actor);
            $em->flush();
            return $actor;
        } else {
            return $form;
        }
    }

    public function putActorAction(Request $request, $id){
        $actor = $this->getDoctrine()->getRepository('CoreBundle:Actor')->findOneById($id);
        if(!is_object($actor)){
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(ActorType::class, $actor);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($actor);
            $em->flush();
            return $actor;
        } else {
            return $form;
        }
    }

    public function deleteActorAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $actor = $em->getRepository('CoreBundle:Actor')->findOneById($id);
        if(is_object($actor)){
            $em->remove($actor);
            $em->flush();
        }
    }
}
