<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Entity\Template;
use CoreBundle\Entity\Role;
use CoreBundle\Controller\TemplateController;

class TemplateSetupController extends TemplateController
{

    const CLASS_PATH = Template::class;
    const GROUP_NAME = 'template';

    public function indexAction()
    {
        $this->denyAccessUnlessGranted(Role::ROLE_TEMPLATESETUP, null, self::ACCESS_DENIED_ROLE_MSG);

        $template = $this->get('core.service.template');
        $templateMapper = $template->getTemplateMapper();

        $templateMapper
            ->add('route_info', $this->generateUrl('backend_setuptemplate_info'))
            ->addButtonHeader(['info'])
        ;

        $entity = $this->em()->getRepository(self::CLASS_PATH)->findAll();
        $entity = $this->getSerializeDecode($entity, self::GROUP_NAME);

        return $this->render(
            'BackendBundle:TemplateSetup:index.html.twig',
            [
                'entity' => $entity,
                'template' => $templateMapper->getDefaults(),
                'buttonHeader' => $templateMapper->getButtonHeader(),
            ]
        );
    }

    public function assignAction(Request $request)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $this->denyAccessUnlessGranted(Role::ROLE_TEMPLATESETUP, null, self::ACCESS_DENIED_ROLE_MSG);

        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        $id = $request->get('id');
        $repository = $this->em()->getRepository(self::CLASS_PATH);
        $entityTemplate = $repository->find($id);
        $entities = $repository->findAll();

        try {

            if($entities){
                foreach ($entities as $key => $entity){
                    $entity->setIsActiveTemplate(false);
                    $this->persist($entity);
                }
            }

            if($entityTemplate){
                $entityTemplate->setIsActiveTemplate(true);
                $this->persist($entityTemplate);

                $status = self::AJAX_STATUS_SUCCESS;
            }

        }catch (\Exception $e){
            $errors[] = $e->getMessage();
        }

        return $this->json([
            'status' => $status,
            'errors' => $errors,
            'id' => $id,
        ]);
    }

    public function manageAction($template_id)
    {
        $this->denyAccessUnlessGranted(Role::ROLE_TEMPLATESETUP, null, self::ACCESS_DENIED_ROLE_MSG);

        $template = $this->get('core.service.template');
        $templateMapper = $template->getTemplateMapper();

        $templateMapper
            ->add('route_info', $this->generateUrl('backend_setuptemplate_info'))
            ->addButtonHeader(['info'])
        ;

        $entity = $this->em()->getRepository(self::CLASS_PATH)->findActiveTemplateById($template_id);
        $entity = $this->getSerializeDecode($entity, self::GROUP_NAME);

        if (!$entity) {
            throw $this->createNotFoundException(self::NOT_FOUND_MSG);
        }

        return $this->render(
            'BackendBundle:TemplateSetup:manage.html.twig',
            [
                'entity' => $entity,
                'template' => $templateMapper->getDefaults(),
                'buttonHeader' => $templateMapper->getButtonHeader(),
                'settings' => $templateMapper->getSettings(),
            ]
        );
    }

    public function infoAction(Request $request)
    {
        $template = $this->get('core.service.template');
        $templateMapper = $template->getTemplateMapper();

        return parent::info($request, $templateMapper);
    }

}
