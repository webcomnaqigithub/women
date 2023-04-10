:star: Star us on [GitHub](https://github.com/aimeos/aimeos/stargazers) — it motivates us a lot! 😀

![Aimeos GitHub stats](https://github-readme-stats.vercel.app/api?username=aimeos&count_private=true&include_all_commits=true&show_icons=true&bg_color=90,103050,109095&title_color=fff&text_color=fff&icon_color=fff&hide=prs)

<a href="https://aimeos.org/">
    <img src="https://aimeos.org/fileadmin/template/icons/logo.png" alt="Aimeos logo" title="Aimeos" align="right" height="60" />
</a>

# Aimeos Laravel ecommerce platform

[![Total Downloads](https://poser.pugx.org/aimeos/aimeos/d/total.svg)](https://packagist.org/packages/aimeos/aimeos)
[![License](https://poser.pugx.org/aimeos/aimeos/license.svg)](https://packagist.org/packages/aimeos/aimeos)

[Aimeos](https://aimeos.org/Laravel) is THE professional, full-featured and
high performance e-commerce platform! You can install it within 5 minutes
and can adapt, extend, overwrite and customize anything to your needs.

[![Aimeos Laravel demo](https://aimeos.org/fileadmin/aimeos.org/images/aimeos-github.png)](https://laravel.demo.aimeos.org)

## Features

Aimeos is a full-featured e-commerce package:

* Multi vendor, multi channel and multi warehouse
* From one to 1,000,000,000+ items
* Extremly fast down to 20ms
* For multi-tentant e-commerce SaaS solutions
* Bundles, vouchers, virtual, configurable, custom and event products
* Subscriptions with recurring payments
* 100+ payment gateways
* Full RTL support (frontend and backend)
* Block/tier pricing out of the box
* Extension for customer/group based prices
* Discount and voucher support
* Flexible basket rule system
* Full-featured admin backend
* Beautiful admin dashboard
* Configurable product data sets
* JSON REST API based on jsonapi.org
* Completly modular structure
* Extremely configurable and extensible
* Extension for market places with millions of vendors
* Fully SEO optimized including rich snippets
* Translated to 30+ languages
* AI-based text translation
* Optimized for smart phones and tablets
* Secure and reviewed implementation
* High quality source code

... and [more Aimeos features](https://aimeos.org/features)

Check out the demos:

* [Aimeos frontend demo](https://laravel.demo.aimeos.org)
* [Aimeos admin demo](https://admin.demo.aimeos.org)

## Package only

Want to **integrate Aimeos** into your **existing application**?

Use the [Aimeos Laravel package](https://github.com/aimeos/aimeos-laravel) directly!

## Table of content

- [Requirements](#requirements)
- [Installation](#installation)
- [Frontend](#frontend)
- [Backend](#backend)
- [Customize](#customize)
- [Multi-vendor](#multi-vendor)
- [License](#license)
- [Links](#links)

## Requirements

The Aimeos shop distribution requires:
- Linux/Unix, WAMP/XAMP or MacOS environment
- PHP >= 7.3
- MySQL >= 5.7.8, MariaDB >= 10.2.2
- Web server (Apache, Nginx or integrated PHP web server for testing)

If required PHP extensions are missing, `composer` will tell you about the missing
dependencies.

If you want to **upgrade between major versions**, please have a look into the
[upgrade guide](https://aimeos.org/docs/latest/laravel/setup/#upgrade)!

## Installation

To install the Aimeos shop application, you need [composer 2.1+](https://getcomposer.org).
On the CLI, execute this command for a complete installation including a working setup:

```
wget https://getcomposer.org/download/latest-stable/composer.phar -O composer
php composer create-project aimeos/aimeos myshop
```

You will be asked for the parameters of your database and mail server as well as an
e-mail and password used for creating the administration account.

In a local environment, you can use the integrated PHP web server to test your new Aimeos
installation. Simply execute the following command to start the web server:

```
cd myshop
php artisan serve
```

**Note:** In an hosting environment, the document root of your virtual host must point to
the **/.../myshop/public/** directory and you have to change the `APP_URL` setting in your `.env`
file to your domain without port, e.g.:

```
APP_URL=http://myhostingdomain.com
```

## Frontend

After the installation, you can test the Aimeos shop frontend by calling the URL of your
VHost in your browser. If you use the integrated PHP web server, you should browse
this URL: [http://127.0.0.1:8000](http://127.0.0.1:8000)

[![Aimeos frontend](https://aimeos.org/fileadmin/aimeos.org/images/aimeos-frontend.jpg?2021.07)](http://laravel.demo.aimeos.org/)

## Backend

The Aimeos administration interface will be available at `/admin` in your VHost. When using
the integrated PHP web server, call this URL: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)

[![Aimeos admin backend](https://aimeos.org/fileadmin/aimeos.org/images/aimeos-backend.png?2021.04)](http://admin.demo.aimeos.org/)

## Customize

Laravel and the Aimeos e-commerce package are extremely flexible and highly customizable.
A lot of documentation for the [Laravel framework](https://laravel.com) and the
[Aimeos e-commerce framework](https://aimeos.org/docs/latest/laravel) exists. If you have questions
about Aimeos, don't hesitate to ask in our [Aimeos forum](https://aimeos.org/help/).

For more details about Aimeos Laravel integration, please have a look at its
[repository](https://github.com/aimeos/aimeos-laravel).

## Multi-language

For shops which offers multiple languages, just add this line to your `./myshop/.env` file:

```
SHOP_MULTILOCALE=true
```

Then, the language will be added to the routes automatically. You can set up the available
languages in the ["Locale > Locale" panel](https://aimeos.org/docs/latest/manual/locales/)
of the Aimeos admin backend.

## Multi-vendor

To enable multi-vendor features, add this settings to the `./myshop/.env` file:

```
SHOP_MULTISHOP=true
```

If you want to allow vendors to register themselves as sellers, set this option in the
`./myshop/.env` file too:

```
SHOP_REGISTRATION=true
```

By default, newly registered sellers have administrator privileges in the backend for
their own site. For a more limited access to the backend, you can change the permission
level to "editor" in the `./myshop/.env` file:

```
SHOP_PERMISSION=editor
```

You can change the permissions associated to "admin" or "editor" by adding your own version
of the [JQAdm resource configuration](https://github.com/aimeos/ai-admin-jqadm/blob/master/config/admin/jqadm/resource.php)
to the "admin" section of your `./config/shop.php` file.

## License

The Aimeos shop system is licensed under the terms of the MIT and LGPLv3 license and
is available for free.

## Links

* [Web site](https://aimeos.org/Laravel)
* [Documentation](https://aimeos.org/docs/latest/laravel)
* [Forum](https://aimeos.org/help/laravel-package-f18/)
* [Issue tracker](https://github.com/aimeos/aimeos/issues)
* [Composer packages](https://packagist.org/packages/aimeos/aimeos)
* [Source code](https://github.com/aimeos/aimeos)


# Aimeos site tree extension

## Basic usage

The extension replaces the locale site handling in the data management layer
and in the administration interface. It enables you to add sub-sites to each
top level site ("default" is the standard one). Each sub-site can have own
sub-sites too, so you can create a tree of sites with unlimited width and depth.

By default, sub-sites inherit data from their parent sites, e.g.

```
|- default
 |- site-lvl-1
  |- site-lvl-2
```

the site "site-lvl-2" would inherit products and their data created in the sites
"default" and "site-lvl-1". This does work in all data domains but e.g. not in
the order domain where it makes no sense.

## Setup

Please make sure you execute the Aimeos database setup script afterwards to the
necessary tables will be created:

Laravel: php artisan aimeos:setup
Symfony: php bin/console aimeos:setup
TYPO3: Update button in Extension Manager

## Market place configuration

The simplest setup for a market place is to create one sub-site for each vendor
below the "default" site. These vendor sub-sites will inherit e.g. delivery and
payment services as well as all other data created in the "default" site so each
vendor site is a completely usable shop of its own.

To aggregate the products added by the vendors in their own sites into your
market place, you have to add this configuration for the frontend and the
scheduled jobs but not for the backend (admin interface):

`mshop/locale/manager/sitelevel = 3`

If you only want to aggregate the data into the market place site ("default")
and don't want data to be inherited from parent sites, you have to set the
configuration option to

`mshop/locale/manager/sitelevel = 2`

Other possible values are:

Inheritance only (standard value):

`mshop/locale/manager/sitelevel = 1`

No inheritance or aggregation:

`mshop/locale/manager/sitelevel = 0`

For Laravel, you need to add in your `./config/shop.php` in the "mshop" section e.g.:

```
'mshop' => [
	'locale' => [
		'manager' => [
			'sitelevel' => 3
		]
	]
]
```

For TYPO3, add in your project-specific Aimeos extension to `./Resources/Private/Config/mshop.php`:

```
<?php
return [
	'locale' => [
		'manager' => [
			'sitelevel' => 3
		]
	]
];
```

## Dropshipping configuration

To enable dropshipping, only this setting is required:

`mshop/order/manager/sitemode = 2`

For Laravel, you need to add in your `./config/shop.php` in the "mshop" section e.g.:

```
'mshop' => [
	'order' => [
		'manager' => [
			'sitemode' => 2
		]
	]
]
```

For TYPO3, add in your project-specific Aimeos extension to `./Resources/Private/Config/mshop.php`:

```
<?php
return [
	'order' => [
		'manager' => [
			'sitemode' => 2
		]
	]
];
```

Dropshipping does also work in market place mode if you use this configuration:

```
mshop/locale/manager/sitelevel = 3
mshop/order/manager/sitemode = 2
```

## B2B configuration options

If you want to control in the administration interface if inherited categories
or products are used in the sub-site or not, you have to add these configuration
settings for the **frontend** configuration section:

```
'mshop' => [
	'catalog' => [
		'manager' => [
			'decorators' => [
				'local' => [
					'Site' => 'Site',
				],
			],
			'submanagers' => [
				'lists' => 'lists',
				'site' => 'site',
			],
		],
	],
	'index' => [
		'manager' => [
			'decorators' => [
				'local' => [
					'Site' => 'Site',
				],
			],
		],
	],
	'product' => [
		'manager' => [
			'decorators' => [
				'local' => [
					'Site' => 'Site',
				],
			],
			'submanagers' => [
				'type' => 'type',
				'property' => 'property',
				'lists' => 'lists',
				'site' => 'site',
			],
		],
	],
],
```

Then, categories and products aren't used until you explicitly allow them to be shown.

As last step, you need to rebuild the product index (in the mshop_index_* tables)
for your market place site ("default"). Due to the settings above, the index
will then contain the products from the vendor sites too.

**Caution:**
If you use the extension in combination with the ai-elastic Extension, enabling/disabling
inherited products isn't possible in that setup and you have to remove the "Site" decorator
the the "site" submanager from the configuration:

```
'mshop' => [
	'catalog' => [
		'manager' => [
			'decorators' => [
				'local' => [
					'Site' => 'Site',
				],
			],
			'submanagers' => [
				'lists' => 'lists',
				'site' => 'site',
			],
		],
	],
	'product' => [
		'manager' => [
			'submanagers' => [
				'type' => 'type',
				'property' => 'property',
				'lists' => 'lists',
			],
		],
	],
],
```

## TYPO3

In TYPO3, you can additionally assign a single site to a page or page tree via Typoscript.

Frontend (Setup TS):
`plugin.tx_aimeos.settings.mshop.locale.site = <sitecode>`

Backend: (Page TS in "Resource" tab):
`mshop.locale.site = <sitecode>`
# Wemanpro
# Wemanpro
