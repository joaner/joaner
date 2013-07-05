<?php

return array(
	'core' => array(
			
		'request' => array(
				'router' => array(
						'default' => 'path',
						'index' => array(
								'namespace' => '',
								'controller' => 'index'
						)

				)
		),
			
		'cache' => array(
			'default' => 'file',

			'nodes' => array(
				'file' => array(
					'temp_dir' => sys_get_temp_dir()
				),
			)
		),

		'database' => array(
			'default' => 'mongo',

			'nodes' => array(
				'mongo' => array(
					'hostname'	=> 'localhost',
					'port'		=> null,
					'username'	=> null,
					'password'	=> null,
				)

			)
		),

	)
);
