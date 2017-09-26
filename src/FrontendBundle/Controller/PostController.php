<?php

namespace FrontendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PostController extends BaseController
{

    public function indexAction($id, $slug)
    {

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('BackendBundle:User')->findOneBy($id);

        if(is_null($post)){
            $this->notFound('Post no encontrado');
        }

        return $this->render(
            'FrontendBundle:Post:index.html.twig',
            [
                'post' => $post,
            ]
        );

        $em = $this->getDoctrine()->getManager();
//        $section1 = $em->getRepository('MainBundle:Section')->findOneSectionByPosition(Section::POSITION_1);
//


        return $this->render(
            'FrontendBundle:Post:index.html.twig',
            array(
                'section1' => '',
            )
        );

    }

    public function redirectAction()
    {
        $url = $this->generateUrl('frontend_default_index');
        $redirect = new RedirectResponse($url);
        $redirect->setExpires(new \DateTime('+365 day'));
        return $redirect;
    }



}
