<?php

return array(
	'request' => array(
		'router' => 'pathinfo',
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
