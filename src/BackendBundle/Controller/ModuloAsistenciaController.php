<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Form\AclMaskType;
use CoreBundle\Entity\AclMask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use CoreBundle\Entity\Assistance;
use CoreBundle\Controller\BaseController;

class ModuloAsistenciaController extends BaseController {

    public function indexAction()
    {
	    $entities = [];
    	$user = $this->getUser();
	
	    $date = new \DateTime();
	    $dateAssistance = $date->format('Y-m-d');
	
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    		$dateAssistance = $_POST['date_assistance'];
	    }
	
	    if ($user) {
		    $entities = $this->em()->getRepository(Assistance::class)->findAllByUser($user->getId(), $dateAssistance);
		    $entities = $this->getSerializeDecode($entities, "assistance");
	    }
	    
        return $this->render(
            'BackendBundle:ModuloAsistencia:index.html.twig',
            [
                'entities' => $entities,
                'dateAssistance' => $dateAssistance,
            ]
        );
    }



}
