<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Course;
use CoreBundle\Entity\Exam;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Grades;
use CoreBundle\Entity\Assistance;

class RegisterExamGradeController extends BaseController
{

    public function listadoCursosAction()
    {

        $user = $this->getUser();

        if(!$user){
             throw $this->createNotFoundException('SISTEMA: tiene que logearse para tener el objeto usuario');
        }

        $entities = $this->em()->getRepository(Course::class)->findAllByUserId($user->getId());
        $entities = $this->getSerializeDecode($entities, 'course_has_exam');

        return $this->render(
            'BackendBundle:RegisterExamGrade:listado-cursos.html.twig',
            [
                'entities' => $entities,
            ]
        );
    }

    public function listadoAlumnosAction(Request $request, $curso_id)
    {

        $course = $this->em()->getRepository(Course::class)->find($curso_id);

        if(!$course){
            throw $this->createNotFoundException('SISTEMA: el curso no existe');
        }

        $entities = $this->em()->getRepository(User::class)->findAllByCourseId($curso_id, 'alumno');
        $entities = $this->getSerializeDecode($entities, 'course_has_user');

        $exams = $this->em()->getRepository(Exam::class)->findAllByCourseId($curso_id);
        $exams = $this->getSerializeDecode($exams, 'course_has_exam');

        return $this->render(
            'BackendBundle:RegisterExamGrade:listado-alumnos.html.twig',
            [
                'exams' => $exams,
                'course' => $course,
                'entities' => $entities,
            ]
        );
    }

    public function saveGradesAction(Request $request)
    {

        $all = $request->request->all();
        $all = array_shift($all);

        foreach ($all as $key => $value){

            $exam = $this->em()->getRepository(Exam::class)->find($value['exam_id']);

            $grade = new Grades();
            $grade->setCourseId($value['course_id']);
            $grade->setGrade($value['grade']);
            $grade->setExam($exam);
            $this->persist($grade);
        }

        return $this->json([
            'status' => true,
        ]);
    }

}
