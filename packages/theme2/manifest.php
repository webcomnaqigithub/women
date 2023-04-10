<?php

return [
	'name' => 'theme2',
	'config' => [
		'config',
	],
	'depends' => [
		'aimeos-core',
		'ai-admin-jqadm',
		'ai-admin-jsonadm',
		'ai-client-html',
		'ai-client-jsonapi',
		'ai-controller-jobs',
		'ai-controller-frontend',
	],
	'include' => [
		'src',
	],
	'i18n' => [
		'admin' => 'i18n',
		'client' => 'i18n',
		'client/code' => 'i18n',
		'controller/common' => 'i18n',
		'controller/frontend' => 'i18n',
		'controller/jobs' => 'i18n',
		'mshop' => 'i18n',
	],
	'setup' => [
		'setup',
	],
	'template' => [
		'theme2' => [
			'client/jsonapi/templates' => [
				'templates/client/jsonapi',
			],
			'client/html/templates' => [
				'templates/client/html',
			],
			'controller/jobs/templates' => [
				'templates/controller/jobs',
			],
		],
		'admin/jqadm/templates' => [
			'templates/admin/jqadm',
		],
		'admin/jsonadm/templates' => [
			'templates/admin/jsonadm',
		],
	],
	'custom' => [
		'admin/jqadm' => [
			'manifest.jsb2',
		],
		'controller/jobs' => [
			'src',
		],
	],
];
