<?php

namespace FrontendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends BaseController
{

    public function indexAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CoreBundle:User')->findOneBySlug($slug);

        if(is_null($user)){
            $this->notFound('Usuario no encontrado 555');
        }

        return $this->render(
            'FrontendBundle:Profile:index.html.twig',
            [
                'user' => $user,
            ]
        );

    }


}
