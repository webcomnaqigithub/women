<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2022
 */

$enc = $this->encoder();

$selectfcn = function ($list, $key, $value) {
	return (isset($list[$key]) && $list[$key] == $value ? 'selected="selected"' : '');
};
$product = $this->get('product');


$addr = $this->get('addressBilling', []);
$pos = 0;
/// Date format with year (Y), month (m) and day (d). See http://php.net/manual/en/function.date.php
$dateformat = $this->translate('client', 'Y-m-d');
/// Order status (%1$s) and date (%2$s), e.g. "received at 2000-01-01"
$attrformat = $this->translate('client', '%1$s at %2$s');

?>
<div class="bigen-container-shop-data mb-3 ">
	<!-- Breadcrumbs -->
	<div class="container">
		<div class="breadcrumbs ">
			<ul>
				<li><a href="<?= airoute('aimeos_home', ['site' => 'default']) ?>"><?= $enc->html($this->translate('client', 'Main')) ?></a></li>
				<li>
					<a href="/<?= app()->getLocale() . '/profile/' . app('aimeos.context')->get()->locale()->getSiteItem()->getCode() ?>">
						<i class="fa fa-angle-left" aria-hidden="true"></i><?= $enc->html($this->translate('client', 'Profile personly')) ?>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!--  shop profile-->
	<div class="container">
		<div class="row  ">
			<!-- /.col-md-4 -->
			<div class="col-md-1"></div>
			<div class="col-md-10 tab-div">
				<h4>اضافة عنوان جديد</h4>
				<form method="POST" action="<?= route('front.store_address', ['locale' => app()->getLocale()]) ?>" id="address-form">
					<?= $this->csrf()->formfield() ?>
					<input type="hidden" name="usid" value="<?= auth()->user()->id ?? '' ?>">
					<div class="row Register-input mt-2">
						<div class="col-md-6 my-1">
							<label> <?= $enc->html($this->translate('client', 'Full Name')) ?></label>
							<input type="text" name="firstname" class="form-control" placeholder="<?= $enc->html($this->translate('client', 'Full Name')) ?>" value="<?= old('firstname')?>">
							<div class="text-danger"><?= $this->get('errors')->first('firstname')?></div>
						</div>
						<div class="col-md-6 my-1">
							<label><?= $enc->html($this->translate('client', 'Mobile number')) ?></label>
							<div>
								<input type="tel" class="form-control input-tel" name="telephone" value="<?= old('telephone')?>">
								<div class="text-danger"><?= $this->get('errors')->first('telephone')?></div>
							</div>
						</div>
						<div class="col-md-6  my-1">
							<label><?= $enc->html($this->translate('client', 'The state')) ?></label>
							<select class="form-control select" name="countryid">
								<option selected disabled> <?= $enc->html($this->translate('client', 'The state')) ?></option>
								<?php foreach( $this->get( 'addressCountries', [] ) as $countryId ) : ?>
									<option value="<?= $enc->attr( $countryId ) ?>"  <?php if($countryId == old('countryid')):?> selected <?php endif?>>
										<?= $enc->html( $this->translate( 'country', $countryId ) ) ?>
									</option>
								<?php endforeach ?>
							</select>
							<div class="text-danger"><?= $this->get('errors')->first('countryid')?></div>
						</div>
						<div class="col-md-6  my-1">
							<label><?= $enc->html($this->translate('client', 'City')) ?></label>
							<select class="form-control select" name="city">
								<option selected disabled> <?= $enc->html($this->translate('client', 'City')) ?></option>
								<option value="غزة" <?php if(old('countryid') == 'غزة'):?> selected <?php endif?>>غزة</option>
							</select>
							<div class="text-danger"><?= $this->get('errors')->first('city')?></div>
						</div>
						<div class="col-md-6  my-1">
							<label><?= $enc->html($this->translate('client', 'street')) ?></label>
							<input type="text" class="form-control" name="address1" placeholder=" <?= $enc->html($this->translate('client', 'street')) ?>" value="<?= old('address1')?>">
							<div class="text-danger"><?= $this->get('errors')->first('address1')?></div>
						</div>
						<div class="col-md-6  my-1">
							<label><?= $enc->html($this->translate('client', 'ZIP code')) ?></label>
							<input type="text" class="form-control" name="postal" placeholder="مثال : P860" value="<?= old('postal')?>">
							<div class="text-danger"><?= $this->get('errors')->first('postal')?></div>
						</div>
						<div class="col-md-6  my-1">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="customSwitches" name="default" value="1">
								<label class="custom-control-label" for="customSwitches"><?= $enc->html($this->translate('client', 'Set as default shipping address')) ?></label>
							</div>
						</div>
						<div class="col-12 mt-2 d-flex justify-content-center">
							<button class="button-addres-save mr-2" value="1" onclick="Addres_save()">
								<i class="fa  fa-check  "></i>
								<?= $enc->html($this->translate('client', 'save address')) ?>
							</button>
						</div>
					</div>
				</form>
			</div>
			<!-- /.col-md-8 -->
		</div>
	</div>
</div>