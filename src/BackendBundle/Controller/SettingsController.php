<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\ChangePassword;
use CoreBundle\Entity\Files;
use BackendBundle\Form\UserEditType;
use BackendBundle\Form\UserAvatarType;
use BackendBundle\Form\UserPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class SettingsController extends BaseController {

    public function mimetypeAction(Request $request)
    {

        return $this->render(
        'BackendBundle:Googledrivesettings:index.html.twig',
            [
                'auth_url' => '',
            ]
        );
    }

}



