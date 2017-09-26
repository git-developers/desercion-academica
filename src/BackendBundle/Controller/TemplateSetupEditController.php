<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Controller\TemplateController;
use CoreBundle\Controller\CrudController;


class TemplateSetupEditController extends CrudController
{

    public function indexAction($template_id)
    {
        $templateHasModule = $this->em()->getRepository(TemplateHasModule::class)->findActiveTemplateById($template_id);
        $id = $templateHasModule->getIdIncrement();

        $url = $this->generateUrl('backend_setupedittemplate_module', ['template_has_module_id' => $id]);
        $redirect = new RedirectResponse($url, 301);
        $redirect->setExpires(new \DateTime('+365 day'));
        return $redirect;
    }

    public function moduleAction($template_has_module_id)
    {
        $m = $this->get('core.module');
        $templateHasModule = $m->getTemplateHasModule($template_has_module_id);

        $defaults = $m->defaults($templateHasModule);
        $accordion = $m->accordion($templateHasModule);
        $carousels = $m->carousels($templateHasModule);

        $crudDefaults = $m->crudDefaults($templateHasModule);
        $crudDataTable = $m->crudDataTable($templateHasModule);

        $moduleTemplate = $m->moduleTemplate($templateHasModule);
        $objectModule = $m->moduleObject($templateHasModule);
        $templateHasModuleTree = $m->moduleTree($templateHasModule);

        return $this->render(
            $moduleTemplate,
            [
                'objectModule' => $objectModule,
                'templateHasModule' => $templateHasModule,
                'templateHasModuleTree' => $templateHasModuleTree,

                'defaults' => $defaults,
                'accordion' => $accordion,
                'carousels' => $carousels,

                'crud' => $crudDefaults,
                'dataTable' => $crudDataTable,
            ]
        );
    }

    public function moduleSaveAction(Request $request)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $id = null;
        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        try{
            $m = $this->get('core.module');
            $template_has_module_id = $request->get('template_has_module_id');
            $templateHasModule = $m->getTemplateHasModule($template_has_module_id);
            $id = $m->save($templateHasModule);

            $status = self::AJAX_STATUS_SUCCESS;
        }catch (\Exception $e){
            $errors[] = $e->getMessage();
        }

        return $this->json([
            'status' => $status,
            'errors' => $errors,
            'id' => $id,
        ]);
    }

    public function createAction(Request $request)
    {
        $m = $this->get('core.module');
        $templateHasModule = $m->getTemplateHasModuleByRequest();
        $formTemplate = $m->getFormTemplate($templateHasModule);

        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('form_data', $request->get('form_data'))
            ->add('form_type', $m->getFormType($templateHasModule))
            ->add('class_path', $m->getClassPath($templateHasModule))
            ->add('group_name', $m->getGroupName($templateHasModule))
            ->add('template_create', $crudMapper->getFormTemplate($formTemplate))
        ;

//        echo '<pre> POLLO 3333:: ';
//        print_r($crudMapper->getFormTemplate($formTemplate));
//        exit;

        return parent::create($request, $crudMapper);
    }

    public function editAction(Request $request)
    {
        $m = $this->get('core.module');
        $templateHasModule = $m->getTemplateHasModuleByRequest();
        $formTemplate = $m->getFormTemplate($templateHasModule);

        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('form_data', $request->get('form_data'))
            ->add('form_type', $m->getFormType($templateHasModule))
            ->add('class_path', $m->getClassPath($templateHasModule))
            ->add('group_name', $m->getGroupName($templateHasModule))
            ->add('template_edit', $crudMapper->getFormTemplate($formTemplate))
        ;

        return parent::edit($request, $crudMapper);
    }

    public function deleteAction(Request $request)
    {
        $m = $this->get('core.module');
        $templateHasModule = $m->getTemplateHasModuleByRequest();
        $deleteTemplate = $m->getDeleteTemplate($templateHasModule);

        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $bundle = $this->getBundleName();
        $controllerName = $this->getControllerName();

        $crudMapper
            ->add('form_data', $request->get('form_data'))
            ->add('class_path', $m->getClassPath($templateHasModule))
            ->add('template_delete', $crudMapper->getDeleteTemplate($bundle, $controllerName, $deleteTemplate))
        ;

        return parent::delete($request, $crudMapper);
    }

    public function viewAction(Request $request)
    {
        $m = $this->get('core.module');
        $templateHasModule = $m->getTemplateHasModuleByRequest();
        $formTemplate = $m->getViewTemplate($templateHasModule);

        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', $m->getClassPath($templateHasModule))
            ->add('template_view', $crudMapper->getViewTemplate($formTemplate))
        ;

        return parent::view($request, $crudMapper);
    }

}
