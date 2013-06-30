<?php

return array(
	'request' => array(
		'router' => array(
			'name' => 'path',
			'default' => array(
				'namespace' => '',
				'controller' => 'index'
			)
		)
	),

	'database' => array(
		'driver' => 'mongo',
		'connection' => array(
			'mongo' => array(
				'hostname'	=> 'localhost',
				'port'		=> null,
				'username'	=> null,
				'password'	=> null,
			)

		)
	)

);
