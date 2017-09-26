<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;
use CoreBundle\Entity\ChangePassword;
use BackendBundle\Form\UserEditType;
use BackendBundle\Form\UserAvatarType;
use BackendBundle\Form\UserPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\File\File;

class User2Controller extends BaseController {

    /*

    select * from acl_classes;
    select * from acl_entries;
    select * from acl_object_identities;
    select * from acl_object_identity_ancestors;
    select * from acl_security_identities;

    delete from acl_classes;
    delete from acl_entries;
    delete from acl_object_identities;
    delete from acl_object_identity_ancestors;
    delete from acl_security_identities;

    */



    public function indexAction(Request $request)
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $active = $request->get('active');

        $user = $this->getUser();
        $entity = $this->em()->getRepository('CoreBundle:User')->find($user->getIdIncrement());

        $formEdit = $this->createForm(UserEditType::class, $entity,  [
//            'action' => $this->generateUrl('backend_user_index'),
//            'method' => 'POST',
            'attr' => ['class' => '']
        ]);

        $formAvatar = $this->createForm(UserAvatarType::class, $entity,  [
            'attr' => ['class' => ''],
        ]);

        $formPassword = $this->createForm(UserPasswordType::class, new ChangePassword,  [
            'attr' => ['class' => '']
        ]);

        if('POST' === $request->getMethod()) {

            if ($request->request->has('user_edit')) {

                $active = 2;
                $formEdit->handleRequest($request);

                $image = $user->getImage();

                if(is_null($image)){
                    $entity->setImage(new File('bundles/core/common/images/no_avatar.jpg'));
                }

                if ($formEdit->isSubmitted() && $formEdit->isValid()) {

                    if(is_null($image)){
                        $entity->setImage(null);
                    }

                    $this->save($entity);
                    $this->flashSuccess('Cambios guardados');
                    return $this->redirectToRoute('backend_user_index', ['active' => 2]);
                }
            }

            if ($request->request->has('user_avatar')) {

                $active = 1;
                $fileName = $user->getAvatarFileName();
                $username = $user->getUsername();
                $formAvatar->handleRequest($request);

                if ($formAvatar->isSubmitted() && $formAvatar->isValid()) {

                    $file = $entity->getImage();

                    //remove avatar
                    $this->get('backend.file_uploader')->removeAvatar($fileName);

                    //upload avatar
                    $fileName = $this->get('backend.file_uploader')->uploadAvatar('user', $username, $file);
                    $entity->setImage($fileName);

                    $this->save($entity);
                    $this->flashSuccess('Cambios guardados');

                    return $this->redirectToRoute('backend_user_index', ['active' => 1]);
                }
            }

            if ($request->request->has('user_password')) {

                $active = 3;
                $formPassword->handleRequest($request);
                if ($formPassword->isSubmitted() && $formPassword->isValid()) {

                    $password = $formPassword->get('newPassword')->getData();
                    $password = $this->get('security.password_encoder')->encodePassword($entity, $password);
                    $entity->setPassword($password);

                    $this->save($entity);
                    $this->flashSuccess('Cambios guardados');
                    return $this->redirectToRoute('backend_user_index', ['active' => 3]);
                }
            }

        }

        return $this->render(
            'BackendBundle:User:index.html.twig',
            [
                'formEdit' => $formEdit->createView(),
                'formAvatar' => $formAvatar->createView(),
                'formPassword' => $formPassword->createView(),
                'active' => ( is_numeric($active) && ($active >= 1 && $active <=3) ) ? $active : 1,
            ]
        );
    }


}
