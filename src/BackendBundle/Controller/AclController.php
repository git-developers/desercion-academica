<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Form\AclMaskType;
use CoreBundle\Entity\AclMask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class AclController extends Controller {

    public function classesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CoreBundle:AclClasses')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('acl_classes'))
        );

        return $this->render(
            'BackendBundle:Acl:classes.html.twig',
            [
                'entitiesJson' => $entitiesJson,
                'formEntity' => '', //$form->createView(),
            ]
        );
    }

    public function objectIdentitiesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CoreBundle:AclObjectIdentities')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('acl_object_identities'))
        );

        return $this->render(
            'BackendBundle:Acl:object_identities.html.twig',
            [
                'entitiesJson' => $entitiesJson,
                'formEntity' => '', //$form->createView(),
            ]
        );

    }

    public function entriesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CoreBundle:AclEntries')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('acl_entries'))
        );

        $entity = new AclMask();
        $form = $this->createForm(AclMaskType::class, $entity, ['attr' => ['class' => 'form-horizontal']] );

        return $this->render(
            'BackendBundle:Acl:entries.html.twig',
            [
                'entitiesJson' => $entitiesJson,
                'formMaskEntity' => $form->createView(),
            ]
        );

    }

    public function changeEntryMaskAction(Request $request)
    {

        $errors = [];
        $status = false;
        $idEntry = null;
        $mask = null;

        $entity = new AclMask();
        $form = $this->createForm(AclMaskType::class, $entity, ['attr' => ['class' => 'form-horizontal']] );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $builder = new MaskBuilder();

            if($entity->isView()){$builder->add('view');}
            if($entity->isCreate()){$builder->add('create');}
            if($entity->isEdit()){$builder->add('edit');}
            if($entity->isDelete()){$builder->add('delete');}
            if($entity->isUndelete()){$builder->add('undelete');}
            if($entity->isOperator()){$builder->add('operator');}
            if($entity->isMaster()){$builder->add('master');}

            $mask = $builder->get();

            $idEntry = $entity->getEntry();
            $em = $this->getDoctrine()->getManager();
            $aclEntries = $em->getRepository('CoreBundle:AclEntries')->findOneById($idEntry);
            $aclEntries->setMask($mask);
            $em->persist($aclEntries);
            $em->flush();

            $status = true;
        }

        return $this->json([
            'status' => $status,
            'errors' => $errors,
            'idEntry' => $idEntry,
            'mask' => $mask,
        ]);
    }

}
