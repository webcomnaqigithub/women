<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();

?>

<div class="bigen-container-Connect ">
    <!-- Breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs ">
            <ul>
                <li><a href="<?= airoute('aimeos_home', ['site' => 'default']) ?>"><?= $enc->html( $this->translate( 'admin', 'Main' ) ) ?></a></li>
                <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> <?= $enc->html( $this->translate( 'admin', 'contact us' ) ) ?></a></li>
                <!-- <li class="active"><a><i class="fa fa-angle-left" aria-hidden="true"></i>نعمل على ...</a></li> -->
            </ul>
        </div>
    </div>
    <div class="container  ">
        <div class="search-shop  ">
            <div><?= $enc->html( $this->translate( 'admin', 'contact us' ) ) ?></div>
            <div><?= $enc->html( $this->translate( 'admin', 'If you have any questions, do not hesitate to contact us' ) ) ?></div>
        </div>
    </div>
	<div class="benefit">
		<div class="container">
			<div class="row benefit_row ">
				<!-- سياسة الارجاع -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item b-l d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="<?= asset('front/images/icon/Return Policy.svg')?>">						  
						</div>
						<div class="benefit_details">
							<div class="details-title"><?= $this->translate( 'client', 'Return Policy' )?></div>
							<div class="details-sub-title">100%<?= $this->translate( 'client', 'money back guarantee' )?></div>
							
						</div>
				
					</div>
				</div>
				<!-- طرق دفع آمنة -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item b-l d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="<?= asset('front/images/icon/Safe Payment Methods.svg')?>">						  
						</div>
						<div class="benefit_details">
							<div class="details-title"> <?= $this->translate( 'client', 'Safe Payment Methods' )?></div>
							<div class="details-sub-title"> <?= $this->translate( 'client', 'multi payment' )?></div>
							
						</div>
				
					</div>
				</div>
				<!-- مركز المساعدة -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item b-l d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="<?= asset('front/images/icon/Help Center.svg')?>">
						</div>
						<div class="benefit_details">
							<div class="details-title"> <?= $this->translate( 'client', 'Help Center' )?></div>
							<div class="details-sub-title"> <?= $this->translate( 'client', '24/7 support system' )?></div>
							
						</div>
				
					</div>
				</div>
				<!-- شحن لجميع الدول -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="<?= asset('front/images/icon/Shipping to all countries.svg')?>">
						</div>
						<div class="benefit_details">
							<div class="details-title"> <?= $this->translate( 'client', 'Shipping to all countries' )?></div>
							<div class="details-sub-title"> <?= $this->translate( 'client', 'fast and instant' )?></div>
							
						</div>
				
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="container mt-3">
        <div class="Connect-details     ">
            <h4><?= $enc->html( $this->translate( 'admin', 'contact us' ) ) ?></h4>
            <div class="Connect-details-call my-4">
                <div class="call">
                    <img src="/front/images/icon/call.svg">
                    <div class="mr-2">
                        <div><?= $enc->html( $this->translate( 'admin', 'Telephone' ) ) ?></div>
                        <div>+970 59123 4567</div>
                    </div>
                </div>
                <div class="mass">
                    <img src="/front/images/icon/mass.svg">
                    <div class="mr-2">
                        <div><?= $enc->html( $this->translate( 'admin', 'E-mail' ) ) ?></div>
                        <div>Palestinian@gmail.com</div>
                    </div>
                </div>
                <div class="loc">
                    <img src="/front/images/icon/loc.svg">
                    <div class="mr-2">
                        <div><?= $enc->html( $this->translate( 'admin', 'the address' ) ) ?></div>
                        <div>فلسطين - غزة - شارع عمر المختار</div>
                    </div>
                </div>
            </div>
            <form action="<?= airoute('front.contactus.store') ?>" method="POST">
                <?= $this->csrf()->formfield() ?>
                <div class="row Connect-details-input my-3 ">
                    <div class="col-md-4  my-1 text-right">
                        <label><?= $enc->html( $this->translate( 'admin', 'Full Name' ) ) ?></label>
                        <input type="text" name="name" class="  form-control" placeholder="<?= $enc->html( $this->translate( 'admin', 'Full Name' ) ) ?>">
                    </div>
                </div>
                <div class="row Connect-details-input my-3">
                    <div class="col-md-4  my-1 text-right">
                        <label><?= $enc->html( $this->translate( 'admin', 'Mobile number' ) ) ?></label>
                        <!-- <input type="text" class="  form-control" placeholder="أدخل رقم الجوال"> -->
                        <div>
                            <div class="intl-tel-input allow-dropdown">
                                <div class="flag-container">
                                    <div class="selected-flag" tabindex="0" title="United States: +1">
                                        <div class="iti-flag us"></div>
                                        <div class="iti-arrow"></div>
                                    </div>
                                </div>
                                <input type="tel" name="phone" class="form-control input-tel" autocomplete="off" placeholder="(201) 555-5555">
                                <?= $this->get('errors')?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row Connect-details-input my-3">
                    <div class="col-md-4  my-1 text-right">
                        <label> <?= $enc->html( $this->translate( 'admin', 'E-mail' ) ) ?></label>
                        <input type="text" class="form-control" name="email" placeholder="<?= $enc->html( $this->translate( 'admin', 'E-mail' ) ) ?> ">
                    </div>
                </div>
                <div class="row Connect-details-input my-3">
                    <div class="col-md-4  my-1 text-right">
                        <label><?= $enc->html( $this->translate( 'admin', 'the message' ) ) ?></label>
                        <textarea type="text" rows="5" name="content" class="form-control" placeholder="<?= $enc->html( $this->translate( 'admin', 'the message' ) ) ?>"></textarea>
                    </div>
                </div>
                <div class="row Connect-details-input px-5 mt-5">
                    <button type="submit" class=" col-md-4 Connect-details-button"> <?= $enc->html( $this->translate( 'admin', 'Send' ) ) ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>