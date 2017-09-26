<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;
use CoreBundle\Entity\PointOfSale;
use BackendBundle\Form\PointOfSaleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class PointOfSaleControllerCOPY extends BaseController {

    public function indexAction()
    {

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_PROFILE')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//            //throw $this->createAccessDeniedException();
//        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CoreBundle:PointOfSale')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('pointofsale'))
        );


//        echo '<pre> POLLO:: ';
//        print_r($entitiesJson);
//        exit;


        return $this->render(
            'BackendBundle:PointOfSale:index.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
                'formEntity' => '', //$form->createView(),
            )
        );

    }
    
    public function createAction(Request $request)
    {

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_PROFILE')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $entity = new PointOfSale();
        //$this->get('backend.form.pointofsaletype')
        $form = $this->createForm(PointOfSaleType::class, $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

//        $all = $request->request->all();

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();


//            MaskBuilder::MASK_OWNER;
//            MaskBuilder::MASK_VIEW;


            //MaskBuilder
            $builder = new MaskBuilder();
            $builder
//                ->add('view')
//                ->add('edit')
//                ->add('delete')
//                ->add('undelete')
                ->add('operator')
            ;
            $mask = $builder->get(); // int(29)

            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $tokenStorage = $this->get('security.token_storage');
            $user = $tokenStorage->getToken()->getUser();
//            $user = $this->getUser();

            $securityIdentity = UserSecurityIdentity::fromAccount($user);
            //$securityIdentity = new RoleSecurityIdentity("ROLE_USUARIO");

            // grant owner access
            $acl->insertObjectAce($securityIdentity, $mask);
//            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            return $this->redirectToRoute('backend_pointofsale_index');
        }

        return $this->render(
            'BackendBundle:PointOfSale:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function viewAction($id)
    {

        /*
        $user = $this->getUser();
        echo '<pre>';
        print_r($user->getRoles());
        exit;
        */



        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:PointOfSale')->findOneByIdIncrement($id);


        echo '<pre> POLLO:: ';
        echo $entity->getIdIncrement() .' -- '.$entity->getName();


        $authorizationChecker = $this->get('security.authorization_checker');

        // check for edit access
        if (false === $authorizationChecker->isGranted('EDIT', $entity)) {
            //throw new AccessDeniedException();
            echo 'Access Denied';
        }else{
            echo 'Access isGranted';
        }

        exit;



    }

    public function editAction(Request $request)
    {

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_PROFILE')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:PointOfSale')->findOneById($id);
        $form = $this->createForm($this->get('backend.form.profiletype'), $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->redirectToRoute('backend_pointofsale_index');
        }

        return $this->render(
            'BackendBundle:PointOfSale:createEdit.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'editar',
                'id' => $id,
            )
        );
    }

    public function deleteAction(Request $request)
    {

        $response = new \stdClass();

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_PROFILE')) {
//            $response->status = "access-denied";
//            $responseJson = json_encode($response);
//            return new Response($responseJson);
//        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:PointOfSale')->findOneById($id);

        try {
            $entity->setActive(0);
            $em->persist($entity);
            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        return new Response(json_encode($response));

    }

}
