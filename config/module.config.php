<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Createdevdbfiles\Controller\Index' => 'Createdevdbfiles\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'createdevdbfiles' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/createdevdbfiles',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Createdevdbfiles\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'base_path' => '../..',
        'template_map' => array(
            'layout/sysadminauth' => __DIR__ . '/../view/layout/index.phtml',
            	
        ),
        'template_path_stack' => array(
            'sysadminauth' => __DIR__ . '/../view',
        ),
    ),
    
    'module_layouts' => array(
        'Createdevdbfiles' => array(
            'default' => 'layout/sysadminauth',
        )
    ),
);
