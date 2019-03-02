<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\CrudController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Crud\Builder\CrudMapper;
use CoreBundle\Entity\ChatBot;
use BackendBundle\Form\ChatBotType;

class ChatBotController extends CrudController {
	
	
	const CLASS_PATH = ChatBot::class;
	const GROUP_NAME = 'chatbot';
	const FORM_TYPE = ChatBotType::class;
	
	
	public function indexAction()
	{
		$crud = $this->get('core.service.crud');
		$crudMapper = $crud->getCrudMapper();
		$dataTable = $crud->getDataTableMapper();
		
		$crudMapper
			->add('section_title', 'Gestionar chat bot')
			->add('section_icon', 'commenting-o')
			->add('class_path', self::CLASS_PATH)
			->add('group_name', self::GROUP_NAME)
			->add('section_box_class', 'primary')
			->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
			->add('test', 'test', [
				'label' => '',
			])
		;
		
		$dataTable
			->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id + '</span>' ")
			->addColumn('Nombre', 'obj.name')
			->addColumn('descripcion', 'obj.description')
			->addColumn('Creado', 'obj.created_at', [
				'icon' => 'calendar'
			])
			->addButtonTable(['edit', 'delete'], 'obj.id')
//			->addButtonHeader(['create', 'info'])
			->addButtonHeader(['create'])
			->addRowCallBack('id', 'aData.id')
			->addRowCallBack('data-id', 'aData.id')
			->addRowCallBack('class', ' "alert" ')
		;

//        $dataTable->setOptions([
//            'pageLength' => 20,
//        ]);
		
		return parent::indexChatBot($crudMapper, $dataTable);
		
	}
	
	public function createAction(Request $request)
	{
		
		$entity = new ChatBot();
		$form = $this->createForm(ChatBotType::class, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			
			try{
				
				if ($form->isValid()) {
					
					$user = $this->getUser();
					$entity->addUser($user);
					$this->persist($entity);
				}else{
					foreach ($form->getErrors(true) as $key => $error) {
						if ($form->isRoot()) {
							$errors[] = $error->getMessage();
						} else {
							$errors[] = $error->getMessage();
						}
					}
				}
				
			}catch (\Exception $e){
				$errors[] = $e->getMessage();
			}
			
			if (empty($errors)) {
				return $this->redirect($this->generateUrl('backend_chatbot_index'));
			}
		}

		
		return $this->render(
			'BackendBundle:ChatBot:create.html.twig',
			[
				'formEntity' => $form->createView(),
			]
		);
	}
	
	public function editAction(Request $request)
	{

		$id = $request->get('id');
		$entity = $this->em()->getRepository(ChatBot::class)->find($id);
		
		$form = $this->createForm(ChatBotType::class, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			
			try{
				
				if ($form->isValid()) {
					$this->persist($entity);
				}else{
					foreach ($form->getErrors(true) as $key => $error) {
						if ($form->isRoot()) {
							$errors[] = $error->getMessage();
						} else {
							$errors[] = $error->getMessage();
						}
					}
				}
				
			}catch (\Exception $e){
				$errors[] = $e->getMessage();
			}
			
			if (empty($errors)) {
				return $this->redirect($this->generateUrl('backend_chatbot_index'));
			}
		}
		
		
		return $this->render(
			'BackendBundle:ChatBot:create.html.twig',
			[
				'formEntity' => $form->createView(),
			]
		);
	}
	
	public function deleteAction(Request $request)
	{
		$crud = $this->get('core.service.crud');
		$crudMapper = $crud->getCrudMapper();
		
		$crudMapper
			->add('class_path', self::CLASS_PATH)
		;
		
		return parent::delete($request, $crudMapper);
	}
	
	
	
    public function searchAction(Request $request)
    {
    	
	    $lastUserMessage = $request->get('lastUserMessage');
	
	    $entity = $this->em()->getRepository(ChatBot::class)->search($lastUserMessage);
	    
	    if ($entity) {
	    	return $this->json([
			    "description" => $entity->getDescription()
		    ]);
	    }
	    
	    return false;
	    
	    return $this->render(
            'BackendBundle:ChatBot:search.html.twig',
            [
                'entity' => $entity,
            ]
        );
    }
	
	public function viewAction(Request $request)
	{
		$crud = $this->get('core.service.crud');
		$crudMapper = $crud->getCrudMapper();
		
		$crudMapper
			->add('class_path', self::CLASS_PATH)
		;
		
		return parent::view($request, $crudMapper);
	}

}
