<?php

return array(
	'routes' => array(
		array('default', '(/<controller>(/<action>(/<id>)))', array(
				'controller' => 'polls',
				'action' => 'index'
			)
		)
	),
	'modules' => array('database', 'orm')
);
