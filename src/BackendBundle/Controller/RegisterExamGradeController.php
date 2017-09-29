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

        $students = $this->em()->getRepository(User::class)->findAllByCourseId($curso_id, 'alumno');
        $students = $this->getSerializeDecode($students, 'course_has_user');

        $exams = $this->em()->getRepository(Exam::class)->findAllByCourseId($curso_id);
        $exams = $this->getSerializeDecode($exams, 'course_has_exam');

        return $this->render(
            'BackendBundle:RegisterExamGrade:listado-alumnos.html.twig',
            [
                'exams' => $exams,
                'course' => $course,
                'students' => $students,
            ]
        );
    }

    public function saveGradesAction(Request $request)
    {

        $fields = $request->get('fields');
        $userId = $request->get('userId');

        $courseI = 0;
        $examI = 0;
        $gradeI = 0;
        $array = [];
        foreach ($fields as $key => $value){

            if($value['name'] == 'course_id'){
                $array[$courseI]['course_id'] = $value['value'];
                $courseI++;
            }

            if($value['name'] == 'exam_id'){
                $array[$examI]['exam_id'] = $value['value'];
                $examI++;
            }

            if($value['name'] == 'grade'){
                $array[$gradeI]['grade'] = $value['value'];
                $gradeI++;
            }

        }


        foreach ($array as $key => $value){

            $exam = $this->em()->getRepository(Exam::class)->find($value['exam_id']);

            $grade = new Grades();
            $grade->setUserId($userId);
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
