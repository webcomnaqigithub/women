<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();


/** client/html/locale/select/currency/url/config
 * Associative list of configuration options used for generating the URL
 *
 * You can specify additional options as key/value pairs used when generating
 * the URLs, like
 *
 *  client/html/<clientname>/url/config = array( 'absoluteUri' => true )
 *
 * The available key/value pairs depend on the application that embeds the e-commerce
 * framework. This is because the infrastructure of the application is used for
 * generating the URLs. The full list of available config options is referenced
 * in the "see also" section of this page.
 *
 * @param string Associative list of configuration options
 * @since 2014.09
 */
$config = $this->config( 'client/html/locale/select/currency/url/config', [] );


?>
<div class="locale-select-currency">
	<h2 class="header"><?= $this->translate( 'client', 'Select currency' ) ?></h2>

	<ul class="select-menu">
		<li class="select-dropdown select-current"><a href="#"><?= $this->translate( 'currency', $this->get( 'selectCurrencyId', 'EUR' ) ) ?></a>
			<ul class="select-dropdown">

				<?php foreach( $this->get( 'selectMap', map() )->get( $this->get( 'selectLanguageId', 'en' ), [] ) as $currency => $locParam ) : ?>
					<li class="select-item <?= ( $currency === $this->get( 'selectCurrencyId', 'EUR' ) ? 'active' : '' ) ?>">
						<a href="<?= $enc->attr( $this->url( $this->request()->getTarget(), $this->param( 'controller' ), $this->param( 'action' ), array_merge( $this->get( 'selectParams', [] ), $locParam ), [], $config ) ) ?>">
							<?= $enc->html( $this->translate( 'currency', $currency ), $enc::TRUST ) ?>
						</a>
					</li>
				<?php endforeach ?>

			</ul>
		</li>
	</ul>

</div>


<!-- ----------to doing ahmed samna-------- -->
<div class=" cursor-pointer"  data-toggle="modal" data-target="#Shipping-to-modal">
	<img src="<?= $enc->attr( $this->content( 'front/images/logo/ps.png' ) ) ?>" width="40">
	USD
</div>

<div class="modal fade" id="Shipping-to-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered bd-example-modal-sm d-flex justify-content-center" role="document">
		<div class="modal-content modal-sm">
			 
			<div class="modal-body languages mt-n3">
				<h5 class="mt-4">
				<img src="{{asset('front/images/icon/Shippingto.png')}}" width="18" height="18" class="mt-1 ml-1">
				اختر نوع العملة
				</h5>
				<div class=" language" data-dismiss="modal">
				<img src="{{asset('front/images/icon/shekel.png')}}" width="35">
				<label>شيكل</label>
				</div>
				<div class=" language" data-dismiss="modal">
				<img src="{{asset('front/images/icon/dollar.png')}}" width="35">
				<label>دولار</label>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ----------to doing ahmed samna-------- -->

