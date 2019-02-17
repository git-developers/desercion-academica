<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Form\AclMaskType;
use CoreBundle\Entity\AclMask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use CoreBundle\Controller\BaseController;
use CoreBundle\Entity\Course;
use CoreBundle\Entity\Grades;

class ModuloResultadoController extends BaseController {

    public function indexAction()
    {
	    $user = $this->getUser();
	
	    if(!$user){
		    throw $this->createNotFoundException('SISTEMA: tiene que logearse para tener el objeto usuario');
	    }
	
	    $courses = $this->em()->getRepository(Course::class)->findAllByUserId($user->getId());
	    $courses = $this->getSerializeDecode($courses, 'course_has_user');
	
	
	    return $this->render(
            'BackendBundle:ModuloResultado:index.html.twig',
            [
	            'courses' => $courses,
            ]
        );
    }
	
	public function listStudentsGradesAction(Request $request)
	{
		$studentId = $request->get('student_id');
		$courseId = $request->get('course_id');
		
		$grades = $this->em()->getRepository(Grades::class)->findGradesByCourseAndUser($courseId, $studentId);
		$grades = $this->getSerializeDecode($grades, 'grades');
		
		return $this->render(
			'BackendBundle:ModuloResultado:listado-alumnos-grades.html.twig',
			[
				'grades' => $grades,
			]
		);
	}

}
