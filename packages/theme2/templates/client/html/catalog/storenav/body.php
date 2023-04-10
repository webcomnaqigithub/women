<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();

?>
<?php if($this->get('store_data') !== null):?>
	<div class="row mt-20px ">
		<div class="col-md-6 shop-profile-deital">
			<div class="logo-shop">
				<img src="<?= $this->get('store_data')->icon?>">
			</div>
			<div class="shop_details">
				<div class="shop-title"><?= $this->get('store_data')->store_label?></div>
				<div class="shop-sub-title"><?= $this->get('store_data')->summary?></div>
				<div class="shop-sub-title" style="width: max-content;">
				<span class="fa fa-map-marker"></span>
				<span class="shop-addres "><?= $this->get('store_data')->city?> - <?= $this->get('store_data')->address1?></span>
				<span class="shop-addres pr-sa">تم بيع <?= $this->get('orders_paided')?></span>
				<span class="shop-addres pr-sa">
					<i class="star_rating fa fa-star"></i><?= $this->get('store_data')->rating ?? '0.00'?>
				</span>
				<span class="shop-addres pr-sa">إنضم في <?= $this->get('store_data')->created_at->format('Y-m-d')?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-6 shop-profile-btn ">
			<div class="mt-10px">
				<a href="https://wa.me/+<?= $this->get('store_data')->phone?>/?text=Hello" class="round mt-n13 contact-merch" data-target="#send-masg">
					<i class="fa fa-whatsapp"></i> تواصل مع المتجر
				</a>
				<button class="btn-add-favorit round mt-n13" data-siteid="<?= app('aimeos.context')->get()->locale()->getSiteItem()->getSiteId()?>">
					<i class="icon-add-favorit cursor-pointer fa fa-heart-o "></i> 
					أضف للمفضلة (0)
				</button>
			</div>
		</div>
	</div>
<?php endif?>