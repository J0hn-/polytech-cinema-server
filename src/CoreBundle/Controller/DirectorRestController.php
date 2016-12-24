<?php

namespace CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
}
