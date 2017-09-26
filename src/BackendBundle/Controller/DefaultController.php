<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_BACKEND_ACCESS')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//            //throw $this->createAccessDeniedException();
//        }

        return $this->render('BackendBundle:Default:index.html.twig');
    }

}
