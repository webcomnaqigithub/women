<?php

return [
	'html' => [
		'themes' => [
			'theme2' => 'theme2',
		],
		// 'common' => [
		// 	'partials' => [
		// 		'products' => [
		// 			'decorators' => [
		// 				'global' => 'ProductWomenTemplate',
		// 			]
		// 		]
		// 	],
		// ],
		'account' => [
			'profile' => [
				'decorators' => [
					'global' => ['ProfileWomenTemplate'],
				]
			]
		],
		'catalog' => [
			'detail' => [
				'decorators' => [
					'global' => ['ProductDetialsWomenTemplate'],
				]
				],
			'filter' => [
				'decorators' => [
					'global' => ['StoreProductFilter'],
				]
				],
			'stage' => [
				'decorators' => [
					'global' => ['StageWomenStore'],
				]
				],
			 
		],
		'basket' => [
			'standard' => [
				'decorators' => [
					'global' => ['BasketWomenStore'],
				]
			]
		],
		'checkout' => [
			'standard' => [
				'decorators' => [
					'global' => ['CheckoutWomenTemplate'],
				],
			],
		'confirm' => [
			'decorators' => [
				'global' => ['ConfirmCheckout'],
				]
			]
		]
		// 'catalog' => [
		// 	'detail' => [
		// 		'decorators' => [
		// 			'global' => ['ProductMyproject'],
		// 		]
		// 	]
		// ]
	],
	'jsonapi' => [
	],

			

];
