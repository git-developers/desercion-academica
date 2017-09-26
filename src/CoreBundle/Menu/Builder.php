<?php

namespace CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    const CIRCLE_1_YELLOW = 'fa-circle-o text-yellow';
    const CIRCLE_2_AQUA = 'fa-circle-o text-aqua';
    const CIRCLE_3_BLUE = 'fa-circle-o text-blue';
    const CIRCLE_4_ORANGE = 'fa-circle-o text-orange';
    const CIRCLE_5_RED = 'fa-circle-o text-red';


    public function mainMenu(FactoryInterface $factory, array $options)
    {
//
//        $user = $this->getUser();
//
//        if($user){
//            echo '<pre>';
//            print_r($user->getRoles());
//            exit;
//        }



        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
            'class' => 'sidebar-menu',
            ],
        ])
        ;


        /**
         * USER
         */
        $child = 'Usuarios';
        $userView = $this->isGranted('ROLE_USER_VIEW');
        $roleView = $this->isGranted('ROLE_ACLROLE_VIEW');
        $profileView = $this->isGranted('ROLE_ACLPROFILE_VIEW');
        $groupOfUsersView = $this->isGranted('ROLE_GROUPOFUSERS_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'childrenAttributes' => [
            'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-user')
        ->setDisplay($userView || $roleView || $profileView || $groupOfUsersView)
        ;

        $menu[$child]->addChild('Listar', [
            'route' => 'backend_user_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($userView)
        ;

        $menu[$child]->addChild('Roles', [
            'route' => 'backend_aclrole_index'
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
        ->setDisplay($roleView)
        ;

        $menu[$child]->addChild('Profile', [
            'route' => 'backend_aclprofile_index'
        ])
        ->setAttribute('icon', self::CIRCLE_3_BLUE)
        ->setDisplay($profileView)
        ;

        $menu[$child]->addChild('Usuarios y grupos', [
            'route' => 'backend_groupofusers_index'
        ])
        ->setAttribute('icon', self::CIRCLE_4_ORANGE)
        ->setDisplay($groupOfUsersView)
        ;



        /**
         * COURSES
         */
        $child = 'Cursos';
        $view = true; //$this->isGranted('ROLE_PRODUCT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-book')
            ->setDisplay($view)
        ;

        $menu[$child]->addChild('Listar', [
            'route' => 'backend_course_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setDisplay($view)
        ;




        /**
         * CATEGORIES
         */
//        $child = 'Categorías';
//        $categoryTreeView = $this->isGranted('ROLE_CATEGORYTREE_VIEW');
//        $menu->addChild($child, [
//            'route' => 'backend_default_index',
//            'extras' => ['safe_label' => true],
//            'childrenAttributes' => [
//                'class' => 'treeview-menu',
//            ],
//        ])
//        ->setAttribute('allow_angle', true)
//        ->setAttribute('class', 'treeview')
//        ->setAttribute('icon', 'fa-fw fa-sitemap')
//        ->setDisplay($categoryTreeView)
//        ;
//
//        $menu[$child]->addChild('Gestionar', [
//            'route' => 'backend_categorytree_index'
//        ])
//        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//        ->setDisplay($categoryTreeView)
//        ;


        /**
         * PRODUCT
         */
        $child = 'Productos';
        $productView = $this->isGranted('ROLE_PRODUCT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-cube')
        ->setDisplay($productView)
        ;

        $menu[$child]->addChild('Listar', [
            'route' => 'backend_product_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($productView)
        ;



        /**
         * CLIENT
         */
//        $child = 'Clientes';
//        $clientView = $this->isGranted('ROLE_CLIENT_VIEW');
//        $menu->addChild($child, [
//            'route' => 'backend_default_index',
//            'extras' => ['safe_label' => true],
//            'childrenAttributes' => [
//                'class' => 'treeview-menu',
//            ],
//        ])
//        ->setAttribute('allow_angle', true)
//        ->setAttribute('class', 'treeview')
//        ->setAttribute('icon', 'fa-fw fa-industry')
//        ->setDisplay($clientView)
//        ;
//
//        $menu[$child]->addChild('Listar', [
//            'route' => 'backend_client_index'
//        ])
//        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//        ->setDisplay($clientView)
//        ;



        /**
         * ACCESS CONTROL LISTS
         */
        $child = 'Access Control Lists';
        $clasesView = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-user-secret')
        ->setDisplay($clasesView)
        ;

        $menu[$child]->addChild('Clases', [
            'route' => 'backend_acl_classes'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;

        $menu[$child]->addChild('Object identities', [
            'route' => 'backend_acl_object_identities'
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
        ->setDisplay($clasesView)
        ;

        $menu[$child]->addChild('Entries', [
            'route' => 'backend_acl_entries'
        ])
        ->setAttribute('icon', self::CIRCLE_3_BLUE)
        ->setDisplay($clasesView)
        ;


        /**
         * ASSOCIATION
         */
        $child = 'Asociación';
        $categoryHasProduct = $this->isGranted('ROLE_CATEGORYTREETOASSIGN_VIEW');
        $pdvHasProduct = $this->isGranted('ROLE_ASSIGNPOINTOFSALEHASPRODUCT_VIEW');
        $userHasPdv = $this->isGranted('ROLE_ASSIGNUSERHASPOINTOFSALE_VIEW');
        $groupHasUser = $this->isGranted('ROLE_ASSIGNGROUPHASUSER_VIEW');
        $templateHasModule = $this->isGranted('ROLE_ASSIGNTEMPLATEHASMODULE_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-exchange')
        ->setDisplay($categoryHasProduct || $pdvHasProduct || $userHasPdv || $groupHasUser || $templateHasModule)
        ;

        $menu[$child]->addChild('Curso <i class="fa fa-fw fa-arrow-right"></i> Docente', [
            'route' => 'backend_assignuserhascourse_index',
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($categoryHasProduct)
        ;

//        $menu[$child]->addChild('Punto venta <i class="fa fa-fw fa-arrow-right"></i> Producto', [
//            'route' => 'backend_assignpointofsalehasproduct_index',
//        ])
//        ->setAttribute('icon', self::CIRCLE_2_AQUA)
//        ->setDisplay($pdvHasProduct)
//        ;
//
//        $menu[$child]->addChild('Usuario <i class="fa fa-fw fa-arrow-right"></i> Punto venta', [
//            'route' => 'backend_assignuserhaspointofsale_index',
//        ])
//        ->setAttribute('icon', self::CIRCLE_3_BLUE)
//        ->setDisplay($userHasPdv)
//        ;
//
//        $menu[$child]->addChild('Grupo <i class="fa fa-fw fa-arrow-right"></i> Usuario', [
//            'route' => 'backend_assigngrouphasuser_index',
//        ])
//        ->setAttribute('icon', self::CIRCLE_4_ORANGE)
//        ->setDisplay($groupHasUser)
//        ;
//
//        $menu[$child]->addChild('Template <i class="fa fa-fw fa-arrow-right"></i> Module', [
//            'route' => 'backend_assigntemplatehasmodule_index',
//        ])
//        ->setAttribute('icon', self::CIRCLE_5_RED)
//        ->setDisplay($templateHasModule)
//        ;



        /**
         * SETTINGS
         */
        $child = 'Settings';
        $loadFixture = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-cog')
        ->setDisplay($loadFixture)
        ;

        $menu[$child]->addChild('Load Fixtures', [
            'route' => 'core_default_load_fixtures'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($loadFixture)
        ;

        $menu[$child]->addChild('GoogleDrive mimetype', [
            'route' => 'backend_googledrivesettings_mimetype'
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
        ->setDisplay($loadFixture)
        ;


        return $menu;
    }

    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    protected function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

}



/*
        <ul class="sidebar-menu">

        <li class="treeview {% if app.request.get('_route') matches '(backend_files)' %}active{% endif %}">
            <a href="{{ path('backend_files_index') }}">
                <i class="fa fa-files-o"></i> <span>Mis archivos</span>
            </a>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-upload"></i> <span>Subir archivo</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="treeview {% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                    <a href="{{ path('backend_googledrive_index') }}">
                        <i class="fa fa-fw fa-google"></i> <span>Google drive</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_index', {id:'my-drive'}) }}"><i class="fa fa-codepen"></i> Mi unidad</a>
                        </li>
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_index', {id:'shared-with-me'}) }}"><i class="fa fa-users"></i> Compartido conmigo</a>
                        </li>
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_revoke_token') }}"><i class="fa fa-fw fa-sign-out"></i> Salir del drive</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                    <a href="{{ path('backend_googledrive_index') }}">
                        <i class="fa fa-fw fa-dropbox"></i> <span>Dropbox</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_index', {id:'my-drive'}) }}"><i class="fa fa-codepen"></i> Mi unidad</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_client)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-industry"></i> <span>Clientes</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_client_index)' %}active{% endif %}">
                    <a href="{{ path('backend_client_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {{ app.request.get('_route') matches '(backend_user|backend_aclrole|backend_aclprofile|backend_groupofusers)' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-fw fa-user"></i> <span>Usuarios</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_user_index)' %}active{% endif %}">
                    <a href="{{ path('backend_user_index') }}"><i class="fa fa-circle-o text-red"></i> <span>Listar</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_aclrole_index)' %}active{% endif %}">
                    <a href="{{ path('backend_aclrole_index') }}"><i class="fa fa-circle-o text-blue"></i> <span>Roles</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_aclprofile_index)' %}active{% endif %}">
                    <a href="{{ path('backend_aclprofile_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Profile</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_groupofusers_index)' %}active{% endif %}">
                    <a href="{{ path('backend_groupofusers_index') }}"><i class="fa fa-circle-o text-orange"></i> <span>Grupo de usuarios</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_pointofsale|backend_pointofsaletree)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-home"></i> <span>Puntos de venta</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_pointofsale_index)' %}active{% endif %}">
                    <a href="{{ path('backend_pointofsale_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_pointofsaletree_index)' %}active{% endif %}">
                    <a href="{{ path('backend_pointofsaletree_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar tree</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_googledrive_index)' %}active{% endif %}">
                    <a href="{{ path('backend_googledrive_index') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Mapa</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_categorytree|backend_categorytreetoassign)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-sitemap"></i> <span>Categor&iacute;as</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_categorytree_index)' %}active{% endif %}">
                    <a href="{{ path('backend_categorytree_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Gestionar</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_product)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-cube"></i> <span>Productos</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_product_index)' %}active{% endif %}">
                    <a href="{{ path('backend_product_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {{ app.request.get('_route') matches '(backend_assignuserhaspointofsale|backend_assigngrouphasuser|backend_assignpointofsalehasproduct|backend_categorytreetoassign|backend_assigntemplatehasmodule)' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-fw fa-exchange"></i> <span>Asignaci&oacute;n</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_categorytreetoassign_index)' %}active{% endif %}">
                    <a href="{{ path('backend_categorytreetoassign_index') }}">
                        <i class="fa fa-circle-o text-blue"></i>
                        <span>Categoría <i class="fa fa-fw fa-arrow-right"></i> Producto</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assignpointofsalehasproduct_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assignpointofsalehasproduct_index') }}">
                        <i class="fa fa-circle-o text-orange"></i>
                        <span>Punto de venta <i class="fa fa-fw fa-arrow-right"></i> Producto</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assignuserhaspointofsale_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assignuserhaspointofsale_index') }}">
                        <i class="fa fa-circle-o text-blue"></i>
                        <span>Usuario <i class="fa fa-fw fa-arrow-right"></i> Punto de venta</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assigngrouphasuser_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assigngrouphasuser_index') }}">
                        <i class="fa fa-circle-o text-orange"></i>
                        <span>Grupo <i class="fa fa-fw fa-arrow-right"></i> Usuario</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assigntemplatehasmodule_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assigntemplatehasmodule_index') }}">
                        <i class="fa fa-circle-o text-orange"></i>
                        <span>Template <i class="fa fa-fw fa-arrow-right"></i> Module</span>
                    </a>
                </li>
            </ul>
        </li>



        <li class="treeview {% if app.request.get('_route') matches '(backend_acl)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-user-secret"></i> <span>Access Control Lists</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_acl_classes)' %}active{% endif %}">
                    <a href="{{ path('backend_acl_classes') }}"><i class="fa fa-circle-o text-red"></i> <span>Clases</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_acl_object_identities)' %}active{% endif %}">
                    <a href="{{ path('backend_acl_object_identities') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Object identities</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_acl_entries)' %}active{% endif %}">
                    <a href="{{ path('backend_acl_entries') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Entries</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_template|backend_templatemodule)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-object-group"></i> <span>Template</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_template_index)' %}active{% endif %}">
                    <a href="{{ path('backend_template_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>List template</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_templatemodule_index)' %}active{% endif %}">
                    <a href="{{ path('backend_templatemodule_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Template module</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_templateecategory_index)' %}active{% endif %}">
                    <a href="{{ path('backend_templateecategory_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Template category</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_setuptemplate|backend_setupedittemplate)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-object-group"></i> <span>Template setup</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_setuptemplate|backend_setupedittemplate)' %}active{% endif %}">
                    <a href="{{ path('backend_setuptemplate_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Choose</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_googledrive|core_default)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-cog"></i> <span>Configuraci&oacute;n</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu menu-open">
                <li class="{% if app.request.get('_route') matches '(core_default_load_fixtures)' %}active{% endif %}">
                    <a href="{{ path('core_default_load_fixtures') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Load Fixtures</span>
                    </a>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-circle-o"></i> Google drive
    <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu menu-open">
                        <li>
                            <a href="{{ path('backend_googledrivesettings_mimetype') }}">
                                <i class="fa fa-circle-o"></i> Mime type
    </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a href="#">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <span class="pull-right-container">
                        <small class="label pull-right bg-red">3</small>
                        <small class="label pull-right bg-blue">17</small>
                    </span>
            </a>
        </li>

    </ul>
*/