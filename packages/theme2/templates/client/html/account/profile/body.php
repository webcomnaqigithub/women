<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2022
 */

use Illuminate\Support\Facades\DB;

$enc = $this->encoder();

$selectfcn = function ($list, $key, $value) {
	return (isset($list[$key]) && $list[$key] == $value ? 'selected="selected"' : '');
};


$addr = $this->get('addressBilling', []);
$pos = 0;
/// Date format with year (Y), month (m) and day (d). See http://php.net/manual/en/function.date.php
$dateformat = $this->translate('client', 'Y-m-d');
/// Order status (%1$s) and date (%2$s), e.g. "received at 2000-01-01"
$attrformat = $this->translate('client', '%1$s at %2$s');

?>
<?php if (isset($this->profileItem)) : ?>
	<?php if (auth()->user()->merchant == true) : ?> 
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
			<div class="container ">
				<div class="imgUp" style="position: static;">
					<input type="submit" style="position: absolute;display:none;" value="حفظ" id="profile-bckgrnd-btn" form="profile-bckgrnd-form">
					<label class="image-upload imagePreview profile-bckgrnd" for="profile_image" id="output">
						<img src="<?= auth()->user()->profile_pic ?? $enc->attr($this->content('front/images/merchant profile.png')) ?>" alt="Avatar" loading="lazy" class="image" style="width:100%;position: relative;z-index: -1;height: 158px;">
					</label>
					<form action="<?= airoute('front.usr.update_background')?>" method="POST" id="profile-bckgrnd-form" enctype="multipart/form-data">
						<?= $this->csrf()->formfield(); ?>
						<input type="hidden" name="usid" value="<?= auth()->user()->id ?>">
						<input type="file" id="profile_image" name="profile_pic" style="display: none;" onchange="loadFile(event)" class="uploadFile">
					</form>
				</div>
				<div class="row  mt-20px bg-shop-profile">
					<div class="col-md-6 shop-profile-deital">
						<div class="logo-shop">
							<img src="<?= auth()->user()->icon ?>">
						</div>
						<div class="shop_details">
							<a href="/<?= app()->getLocale() ?>/shop/<?= app('aimeos.context')->get(false)->locale()->getSiteItem()->getCode() ?>" target="_blank">
								<div class="shop-title" style="color: #000;"><?= auth()->user()->store_label ?></div>
							</a>
							<div class="shop-sub-title">
								<!-- <span class="fa fa-map-marker"></span> -->
								<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
								<span class="shop-addres "><?= auth()->user()->city ?> - <?= auth()->user()->address1 ?></span>
								<span class="shop-addres pr-sa">
									<i class="star_rating fa fa-star"></i>
									<?= auth()->user()->rating ?? 0 ?>
								</span>
							</div>
						</div>
					</div>
					<div class="col-lg-6 shop-profile-btn ">
						<div class="mt-10px">
							<form action="<?= airoute('logout', ['site' => 'default']) ?>" method="POST">
								<?= $this->csrf()->formfield(); ?>
								<button type="submit" class="btn-Sign-out round mt-n13">
									<?= $enc->html($this->translate('client', 'sign out')) ?>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="container mt-3 mb-5">
				<div class="row ">
					<div class="col-md-3    ">
						<div class="ratings">
							<div class="text-right">
								<img src="<?= $enc->attr($this->content('front/images/icon/time.png')) ?>">
								<span class="title"><?= $enc->html($this->translate('client', 'Products in stock')) ?></span>
							</div>
							<div class="totle"><?= $enc->attr($this->get('products')->count()) ?></div>
						</div>
					</div>
					<div class="col-md-3    ">
						<div class="  ratings   ">
							<div class="text-right">
								<img src="<?= $enc->attr($this->content('front/images/icon/truck.png')) ?>">
								<span class="title"><?= $enc->html($this->translate('client', 'Products in delivery')) ?></span>
							</div>
							<div class="totle">0</div>
						</div>
					</div>
					<div class="col-md-3    ">
						<div class="  ratings   ">
							<div class="text-right">
								<img src="<?= $enc->attr($this->content('front/images/icon/complete.png')) ?>">
								<span class="title"><?= $enc->html($this->translate('client', 'Completed orders')) ?></span>
							</div>
							<div class="totle">0</div>
						</div>
					</div>
					<div class="col-md-3    ">
						<div class="  ratings   ">
							<div class="text-right">
								<img src="<?= $enc->attr($this->content('front/images/icon/current.png')) ?>">
								<span class="title"><?= $enc->html($this->translate('client', 'current balance')) ?></span>
							</div>
							<div class="totle">0</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row  ">
					<div class="col-md-2  ">
						<ul class="tab-section nav nav-pills flex-column" id="myTab" role="tablist">
							<li class="nav-item ">
								<a class="nav-link active li-radius-top d-flex " data-toggle="tab" href="#Orders" role="tab" aria-controls="Orders" aria-selected="true">
									<div class="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
											<g id="bag-timer" transform="translate(-364 -188)">
												<path id="Vector" d="M16.8,6.962a4.625,4.625,0,0,0-3.08-1.32v-.76A4.891,4.891,0,0,0,8.363.022a5.147,5.147,0,0,0-4.4,5.04v.58a4.625,4.625,0,0,0-3.08,1.32,4.4,4.4,0,0,0-.83,3.52l.7,5.57c.21,1.95,1,3.95,5.3,3.95h5.58c4.3,0,5.09-2,5.3-3.94l.7-5.59A4.383,4.383,0,0,0,16.8,6.962ZM8.5,1.412a3.485,3.485,0,0,1,3.83,3.47v.7H5.353v-.52A3.761,3.761,0,0,1,8.5,1.412Zm.34,15.17a3.79,3.79,0,1,1,3.79-3.79A3.794,3.794,0,0,1,8.843,16.582Z" transform="translate(367.156 189.998)" fill="#fff" />
												<path id="Vector-2" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75A.755.755,0,0,1,2.006,0a.741.741,0,0,1,.74.75v1.5a.751.751,0,0,1-.36.64l-1.25.75A.794.794,0,0,1,.746,3.75Z" transform="translate(374.254 200.83)" fill="#fff" />
												<path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" transform="translate(388 212) rotate(180)" fill="none" opacity="0" />
											</g>
										</svg>
									</div>
									<span class="mt-2 mr-2"><?= $enc->html($this->translate('client', 'Orders')) ?></span>
								</a>
							</li>
							<li class="nav-item products-list">
								<a class="nav-link li-radius-top d-flex" data-toggle="tab" href="#Products" role="tab" aria-controls="home" aria-selected="true">
									<div class="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20.81 21.13">
											<path id="Vector" d="M20.789,7.02,20.5,4.25C20.079,1.23,18.709,0,15.779,0H5.019C2.079,0,.719,1.23.289,4.28L.019,7.03a4.11,4.11,0,0,0,.82,2.92,4.01,4.01,0,0,0,3.23,1.55A4.093,4.093,0,0,0,7.3,9.86a3.815,3.815,0,0,0,6.24.04,4.1,4.1,0,0,0,3.2,1.6,3.982,3.982,0,0,0,3.28-1.63A4.072,4.072,0,0,0,20.789,7.02Z" fill="#525457" />
											<path id="Vector-2" data-name="Vector" d="M18.74,1.82V4.8a5,5,0,0,1-5,5,.491.491,0,0,1-.49-.49V6.92A3.79,3.79,0,0,0,12.1,3.96a3.881,3.881,0,0,0-2.71-.91,6.854,6.854,0,0,0-.77.04A3.485,3.485,0,0,0,5.49,6.57V9.31A.491.491,0,0,1,5,9.8a5,5,0,0,1-5-5V1.84A1,1,0,0,1,1.34.9a4.671,4.671,0,0,0,.82.2,2.325,2.325,0,0,0,.37.04,3.866,3.866,0,0,0,.48.03A5.081,5.081,0,0,0,6.21,0,4.852,4.852,0,0,0,9.37,1.17,4.788,4.788,0,0,0,12.52.02a5.052,5.052,0,0,0,3.16,1.15,4.578,4.578,0,0,0,.53-.03c.12-.01.23-.02.34-.04a4.818,4.818,0,0,0,.87-.22A1,1,0,0,1,18.74,1.82Z" transform="translate(1.059 11.33)" fill="#525457" />
										</svg>
									</div>
									<span class="mt-2 mr-2"><?= $enc->html($this->translate('client', 'Products')) ?></span>
								</a>
							</li>
							<li class="nav-item ">
								<a class="nav-link li-radius-top d-flex" data-toggle="tab" href="#users" role="tab" aria-controls="home" aria-selected="true">
									<div class="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 20">
											<path id="Fill_1" data-name="Fill 1" d="M0,3.4c0,2.72,3.662,3.425,8,3.425,4.315,0,8-.68,8-3.4S12.339,0,8,0C3.685,0,0,.68,0,3.4Z" transform="translate(0 13.174)" fill="#525457" />
											<path id="Fill_4" data-name="Fill 4" d="M5.294,10.583A5.292,5.292,0,1,0,0,5.291a5.274,5.274,0,0,0,5.294,5.292" transform="translate(2.706)" fill="#525457" />
										</svg>
									</div>
									<span class="mt-2 mr-2"><?= $enc->html($this->translate('client', 'the account')) ?></span>
								</a>
							</li>
						</ul>
					</div>
					<!-- /.col-md-4 -->
					<div class="col-md-10 tab-div">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active " id="Orders" role="tabpanel" aria-labelledby="home-tab">
								<h4><?= $enc->html($this->translate('client', 'Orders')) ?></h4>
								<div class="tab_orders">
									<div class="row">
										<div class="col">
											<div class="tabs_container">
												<ul class="tabs d-flex align-items-md-center justify-content-center">
													<li class="tab active" data-active-tab="tab_Pending_orders"><span><?= $enc->html($this->translate('client', 'pending')) ?>
														</span></li>
													<li class="tab" data-active-tab="tab_current_orders"><span><?= $enc->html($this->translate('client', 'current')) ?></span></li>
													<li class="tab" data-active-tab="tab_Completed_orders"><span><?= $enc->html($this->translate('client', 'completed')) ?></span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row mx-1 mt-n13">
										<?php if (!$this->get('historyItems', map())->isEmpty()) : ?>
											<div id="tab_Pending_orders" class="tab_container active">
												<?php foreach ($this->get('historyItems', []) as $id => $orderItem) : ?>
													<?php foreach ($orderItem->getBaseItem()->getProducts() as $item) : ?> 
														<?php if ($item['order.base.product.statusdelivery'] == -1) : ?>
															<a href="<?= route('front.mrchnt.order.show', ['locale' => app()->getLocale(), 'id' => $orderItem->getBaseItem()->getId()]) ?>">
																<div class="row reviews_col">
																	<div class="col-8 details_user_orders">
																		<div class="reviews-User-profile-img">
																			<img src="<?= DB::table('users')->where('id', $orderItem->getBaseItem()->getCustomerId())->first()->icon ?? '' ?>">
																		</div> 
																		<div class="review">
																			<div class="user_name"><?= $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.firstname'] . ' ' . $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.lastname'] ?></div>
																			<div class="review_date">
																				<!-- <i class="fa fa-map-marker"></i> -->
																				<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
																				<?= $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.city'] ?>
																			</div>
																			<div class="review_date">#437952</div>
																			<div class="review_date">
																				<img src="<?= asset('front/images/icon/box-time.svg') ?>" id="box-time">
																				<?= date('d/m/y h:i A', strtotime($orderItem['order.ctime'])) ?>
																				<!-- <span class="shop-addres pr-sa">AM10:30	</span> -->
																			</div>
																		</div>
																	</div>
																	<div class="col-4 details_button_orders">
																		<div class="button-Pending-order">
																			<button>
																				<?= $enc->html($this->translate('client', 'pending')) ?>
																			</button>
																		</div>
																		<div class="button-details-order  mt-3">
																			<button>
																				<?= $enc->html($this->translate('client', 'details')) ?>
																			</button>
																		</div>
																	</div>
																</div>
															</a>
														<?php endif ?>
													<?php endforeach ?>
												<?php endforeach ?>
											</div>

											<div id="tab_current_orders" class="tab_container ">
												<?php foreach ($this->get('historyItems', []) as $id => $orderItem) : ?>
													<?php foreach ($orderItem->getBaseItem()->getProducts() as $item) : ?>
														<?php if ($item['order.base.product.statusdelivery'] == 2) : ?>
															<?php foreach ($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort() as $vendor => $list) : ?>
																<a href="<?= route('front.mrchnt.order.show', ['locale' => app()->getLocale(), 'id' => $orderItem->getBaseItem()->getId()]) ?>">
																	<div class="row reviews_col">
																		<div class="col-8 details_user_orders">
																			<div class="reviews-User-profile-img">
																				<img src="<?= DB::table('users')->where('id', $orderItem->getBaseItem()->getCustomerId())->first()->icon ?? '' ?>">
																			</div>
																			<div class="review">
																				<div class="user_name"><?= $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.firstname'] . ' ' . $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.lastname'] ?></div>
																				<div class="review_date">
																					<!-- <i class="fa fa-map-marker"></i> -->
																					<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
																					<?= $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.city'] ?>
																				</div>
																				<div class="review_date">#437952</div>
																				<div class="review_date">
																					<img src="<?= asset('front/images/icon/box-time.svg') ?>" id="box-time">
																					<?= date('d/m/y h:i A', strtotime($orderItem['order.ctime'])) ?>
																					<!-- <span class="shop-addres pr-sa">AM10:30	</span> -->
																				</div>
																			</div>
																		</div>
																		<div class="col-4 details_button_orders">
																			<div class="button-proccess-order">
																				<button>
																					<?= $enc->html($this->translate('client', 'Being Processed')) ?>
																				</button>
																			</div>
																			<div class="button-details-order  mt-3">
																				<button>
																					<?= $enc->html($this->translate('client', 'details')) ?>
																				</button>
																			</div>
																		</div>
																	</div>
																</a>
															<?php endforeach  ?>
														<?php endif ?>
													<?php endforeach ?>
												<?php endforeach ?>
											</div>

											<div id="tab_Completed_orders" class="tab_container ">
												<?php foreach ($this->get('historyItems', []) as $id => $orderItem) : ?>
													<?php foreach ($orderItem->getBaseItem()->getProducts() as $item) : ?>
														<?php if ($item['order.base.product.statusdelivery'] == 4) : ?>
															<?php foreach ($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort() as $vendor => $list) : ?>
																<a href="<?= route('front.mrchnt.order.show', ['locale' => app()->getLocale(), 'id' => $orderItem->getBaseItem()->getId()]) ?>">
																	<div class="row reviews_col">
																		<div class="col-8 details_user_orders">
																			<div class="reviews-User-profile-img">
																				<img src="<?= DB::table('users')->where('id', $orderItem->getBaseItem()->getCustomerId())->first()->icon ?? '' ?>">
																			</div>
																			<div class="review">
																				<div class="user_name"><?= $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.firstname'] . ' ' . $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.lastname'] ?></div>
																				<div class="review_date">
																					<!-- <i class="fa fa-map-marker"></i> -->
																					<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
																					<?= $orderItem->getBaseItem()->getAddresses()['delivery'][0]['order.base.address.city'] ?>
																				</div>
																				<div class="review_date">#437952</div>
																				<div class="review_date">
																					<img src="<?= asset('front/images/icon/box-time.svg') ?>" id="box-time">

																					<?= date('d/m/y h:i A', strtotime($orderItem['order.ctime'])) ?>
																					<!-- <span class="shop-addres pr-sa">AM10:30	</span> -->
																				</div>
																			</div>
																		</div>
																		<div class="col-4 details_button_orders">

																			<div class="button-completed-order">
																				<button>
																					<?= $enc->html($this->translate('client', 'completed')) ?>
																				</button>
																			</div>
																			<div class="button-details-order  mt-3">
																				<button>
																					<?= $enc->html($this->translate('client', 'details')) ?>
																				</button>
																			</div>
																		</div>
																	</div>
																</a>
															<?php endforeach  ?>
														<?php endif ?>
													<?php endforeach ?>
												<?php endforeach ?>
											</div>
										<?php endif ?>
									</div>
								</div>
							</div>
							<div class="tab-pane fade " id="Products" role="tabpanel" aria-labelledby="Products-tab">
								<div id="Div_All_Products">
									<div class="row">
										<div class="col-6">
											<h4><?= $enc->html($this->translate('client', 'Products')) ?></h4>
										</div>
										<div class="col-6 add_Products">
											<button class="button-add-Products-new" id="add_Products_new">
												<i class="fa fa-plus"></i>
												<?= $enc->html($this->translate('client', 'Add a new product')) ?>
											</button>
										</div>
									</div>
									<?php foreach ($this->get('products', map())->toArray() as $product) : ?>
										<div class="row Products_col">
											<a href="<?= route('aimeos_shop_list', ['locale' => app()->getLocale(), 'site' => 'default']) . '/' . $product->getUrl() ?>">
												<div class="col-md-8 details_user_Products">
													<div class="img-Products">
														<!-- <img src="images/prod.png"> -->
														<?php foreach ($product->getRefItems('media') as $media) : ?>
															<img src="<?= $enc->attr($this->content('aimeos/' . $media->getPreview(), $media->getFileSystem())) ?>">
															<?php break; ?>
														<?php endforeach ?>
													</div>
													<div class="details_Products">
														<a href="<?= route('aimeos_shop_list', ['locale' => app()->getLocale(), 'site' => 'default']) . '/' . $product->getUrl() ?>" target="_blank">
															<div class="Products_name"><?= $enc->attr($product->getLabel()); ?></div>
														</a>
														<div class="Products_type">
															<?php foreach ($product->getRefItems('catalog') as $key => $category) : ?>
																<?= $enc->attr($category->getLabel()) . ' ' ?>
															<?php endforeach ?>
														</div>
														<div class="Products_number">#<?= $enc->attr($product->getId()); ?></div>
														<div class="Products_price">
															<?php foreach ($product->getRefItems('price') as $price) : ?>
																<?= $enc->attr($price->getValue()) . ' ' ?>
																<?= $this->translate('client', $price->getCurrencyId()) ?>
															<?php endforeach ?>
														</div>
													</div>
												</div>
											</a>
											<div class="col-md-4 details_button_Products">
												<div class="Products-date-time ">
													<i class="fa fa-calendar"></i>
													<span><?= $enc->attr($product->getTimeCreated()); ?></span>
													<!-- <span class="pr-b">AM10:30</span> -->
												</div>
												<div class="button-Products ">
													<a href="<?= airoute('product.edit', ['locale' => app()->getLocale(), 'id' => $product->getId()]) ?>" class="button-Products-edit" data-id="<?= $product->getId() ?>">
														<i class="fa fa-pencil"></i>
														<?= $enc->html($this->translate('client', 'Modify')) ?>
													</a>
													<button class="button-Products-delete deleteRecord" data-id="<?= $enc->attr($product->getId()); ?>">
														<i class="fa fa-trash"></i>
														<?= $enc->html($this->translate('client', 'delete')) ?>
													</button>
												</div>
											</div>
										</div>
									<?php endforeach ?>
									<?php if ($enc->attr($this->get('products')->count()) > 10) : ?>
										<!-- <nav aria-label="..." class="my-3">
										<ul class="pagination">
											<li class="page-item">
												<a class="page-link" href="#" tabindex="-1"><i class="fa fa fa-angle-right"></i></a>
											</li>
											<li class="page-item active"><a class="page-link" href="#">1</a></li>
											<li class="page-item"><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">3</a></li>
											<li class="page-item"><a class="page-link" href="#">4</a></li>
											<li class="page-item"><a class="page-link" href="#">5</a></li>
											<li class="page-item"><a class="page-link" href="#">6</a></li>
											<li class="page-item">
												<a class="page-link" href="#"><i class="fa fa fa-angle-left"></i></a>
											</li>
										</ul>
									</nav> -->
									<?php endif ?>
								</div>
								<div id="create_product" style="display:none;">
									<h4><?= $enc->html($this->translate('client', 'Add a new product')) ?></h4>
									<form action="<?= route('front.mrchnt.product.store', ['locale' => 'en', 'site' => app('aimeos.context')->get(false)->locale()->getSiteItem()->getCode(), 'resource' => 'product']) ?>" method="post" enctype="multipart/form-data" name="createProductForm" id="createProductForm" onsubmit="return false">
										<?= $this->csrf()->formfield() ?>
										<input type="hidden" name="usid" value="<?= app('aimeos.context')->get()->locale()->getSiteItem()->getId() ?>">
										<input type="hidden" name="next" value="get">
										<input type="hidden" name="item[product.code]" value="<?= rand(100000, 999999) ?>">
										<div class="row Register-input mt-2">
											<div class="col-md-6  my-1">
												<label><?= $enc->html($this->translate('client', 'product name')) ?></label>
												<input type="text" name="item[product.label]" class="form-control" placeholder="<?= $enc->html($this->translate('client', 'Enter the product name')) ?>" required>
												<input type="hidden" name="item[product.type]" value="default">
												<input type="hidden" name="item[product.status]" value="1">
												<div id="label_error" class="mt-1 text-danger"></div>
											</div>
											<div class="col-md-6  my-1">
												<label><?= $enc->html($this->translate('client', 'Primary classification')) ?></label>
												<input type="hidden" name="category[default-0][product.lists.type]" value="default">
												<select class="form-control select" name='category[default-0][catalog.id]' id="category" required>
													<option selected disabled><?= $enc->html($this->translate('client', 'Choose the main category')) ?></option>
													<?php foreach ($this->get('categories', map())->toArray() as $category) : ?>
														<option value="<?= $category->id ?>"><?= $category->label ?></option>
													<?php endforeach ?>
												</select>
												<div id="label_error" class="mt-1 text-danger"></div>
											</div>
											<div class="col-md-6  my-1">
												<label><?= $enc->html($this->translate('client', 'Subcategory')) ?></label>
												<input type="hidden" name="category[default-1][product.lists.type]" value="default">
												<select class="form-control select" id="sub_categories" name='category[default-1][catalog.id]'>
													<option selected disabled><?= $enc->html($this->translate('client', 'Choose a subcategory')) ?></option>
												</select>
											</div>
											<div class="col-md-6 my-1">
												<label><?= $enc->html($this->translate('client', 'Price in ILS')) ?></label>
												<div class="input-group">
													<input type="text" class="form-control regxnum" name="price[0][price.value]" aria-label="Text input with dropdown button" placeholder="<?= $enc->html($this->translate('client', 'Price')) ?>" required>
													<input type="hidden" name="price[0][price.status]" value="1">
													<input type="hidden" name="price[0][price.type]" value="default">
													<input type="hidden" name="price[0][price.lists.type]" value="default">
													<input type="hidden" name="price[0][price.taxrates][]" value="0">
													<div class="input-group-append">
														<select class="form-control select-input-group-append" name="price[0][price.currencyid]" required>
															<option value="ILS" selected>شيكل</option>
														</select>
													</div>
												</div>
												<div id="currencyid_error" class="mt-1 text-danger"></div>
											</div>
											<div class="col-md-6 my-1">
												<label><?= $enc->html($this->translate('client', 'Price in USD')) ?></label>
												<div class="input-group">
													<input type="text" class="form-control regxnum" name="price[1][price.value]" aria-label="Text input with dropdown button" placeholder="<?= $enc->html($this->translate('client', 'Price')) ?>" required>
													<input type="hidden" name="price[1][price.status]" value="1">
													<input type="hidden" name="price[1][price.type]" value="default">
													<input type="hidden" name="price[1][price.lists.type]" value="default">
													<input type="hidden" name="price[1][price.taxrates][]" value="0">
													<div class="input-group-append">
														<select class="form-control select-input-group-append" name="price[1][price.currencyid]" required>
															<option value="USD" selected>دولار</option>
														</select>
													</div>
												</div>
												<div id="currencyid_error" class="mt-1 text-danger"></div>
											</div>
											<div class="col-md-6  my-1">
												<label><?= $enc->html($this->translate('client', 'Discount')) ?></label>
												<div class="input-group">
													<input type="text" name="price[0][price.rebate]" value="0" class="form-control regxnum" aria-label="Text input with dropdown button" placeholder="<?= $enc->html($this->translate('client', 'Enter the discount rate')) ?>">
													<div class="input-group-append">
														<span class="input-group-text input-group-text-cust">%</span>
													</div>
												</div>
												<div id="rebate_error" class="mt-1 text-danger"></div>
											</div>
											<div class="col-md-6  my-1">
												<label><?= $enc->html($this->translate('client', 'Quantity')) ?></label>
												<input type="text" class="form-control regxnum" name="stock[0][stock.stockdiff]" placeholder="<?= $enc->html($this->translate('client', 'Enter Quantity')) ?>">
												<input type="hidden" class="form-control" name="stock[0][stock.stockflag]" value="1">
											</div>
											<div class="col-md-6  my-1">
												<label><?= $enc->html($this->translate('client', 'Product processing time')) ?></label>
												<input type="hidden" name="characteristic[attribute][1][attribute.type]" value="ProcessingTime">
												<select class="form-control select" name="characteristic[attribute][1][product.lists.refid]" >
													<option><?= $enc->html($this->translate('client', 'Choose the processing time')) ?></option>
													<option value="22"><?= $enc->html($this->translate('client', 'One week or less')) ?></option>
													<option value="23"><?= $enc->html($this->translate('client', 'Two weeks')) ?></option>
													<option value="24"><?= $enc->html($this->translate('client', 'Three weeks')) ?></option>
													<option value="25"><?= $enc->html($this->translate('client', 'One month')) ?></option>
												</select>
											</div>
											<div class="col-md-6 my-1" id="available-sizes" style="display: none;">
												<label> <?= $enc->html($this->translate('client', 'Available sizes')) ?></label>
												<input type="hidden" name="characteristic[attribute][0][attribute.type]" value="size" disabled id="size-attribute">
												<div class="group-label-chack">
													<label class="label-chack">
														<input type="radio" name="characteristic[attribute][0][product.lists.refid]" checked value="21" class="card-input-element" />
														<div class="panel panel-default card-input">
															<div class="panel-heading">S</div>
														</div>
													</label>
													<label class="label-chack">
														<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="20" class="card-input-element" />
														<div class="panel panel-default card-input">
															<div class="panel-heading">M</div>
														</div>
													</label>
													<label class="label-chack">
														<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="19" class="card-input-element" />
														<div class="panel panel-default card-input">
															<div class="panel-heading">L</div>
														</div>
													</label>
													<label class="label-chack">
														<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="18" class="card-input-element" />
														<div class="panel panel-default card-input">
															<div class="panel-heading">XL</div>
														</div>
													</label>
													<label class="label-chack">
														<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="17" class="card-input-element" />
														<div class="panel panel-default card-input">
															<div class="panel-heading">2XL</div>
														</div>
													</label>
												</div>
											</div>
											<div class="col-md-12  my-1">
												<label><?= $enc->html($this->translate('client', 'the description')) ?></label>
												<input type="hidden" name="text[0][product.lists.type]" value="default">
												<input type="hidden" name="text[0][text.status]" value="1">
												<input type="hidden" name="text[0][text.type]" value="long">
												<input type="hidden" name="text[0][text.label]" value="labell">
												<textarea rows="3" type="text" class="form-control" name="text[0][text.content]" placeholder="<?= $enc->html($this->translate('client', 'Enter the description')) ?>" required></textarea>
											</div>
											<div id="content_error" class="mt-1 text-danger"></div>
											<div class="col-md-12 my-2 Products-img">
												<div class="Products-Sub mx-4">
													<label>الصور</label>
													<br>
													<div class="container" style="margin-top: 20px;">
														<div class="row">
															<div class="col-sm-2 imgUp">
																<div class="imagePreview"></div>
																<label class="btn btn-primary">
																	<span><?= $enc->html($this->translate('client', 'upload photo')) ?></span><input type="file" name="media[0][file]" class="uploadFile img" style="width:143px;height:20px;overflow: hidden;">
																	<input type="hidden" name="media[0][media.status]" value="1">
																	<input type="hidden" name="media[0][media.type]" value="default">
																	<input type="hidden" name="media[0][product.lists.type]" value="default">
																	<input type="hidden" name="media[0][media.label]" value="">
																</label>
															</div>
															<i class="fa fa-plus imgAdd"></i>
														</div>
													</div>
												</div>
											</div>
											<div id="file_error" class="mt-1 text-danger"></div>
											<div class="col-12 mt-2 Button_Add_New_Products">
												<button class="button-Products-cancel ml-2">
													<?= $enc->html($this->translate('client', 'Cancel')) ?>
												</button>
												<button type="submit" class="button-Products-save mr-2" id="save-product">
													<i class="fa fa-check"></i>
													حفظ المنتج
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="tab-pane fade " id="users" role="tabpanel" aria-labelledby="users-tab">
								<form action="<?= airoute('front.mrchnt.updateProfile', ['locale' => app()->getLocale()]) ?>" method="POST" enctype="multipart/form-data">
									<?= $this->csrf()->formfield(); ?>
									<input type="hidden" name="usid" value="<?= auth()->user()->id ?>">
									<div class="row">
										<div class="col-10">
											<h4><?= $enc->html($this->translate('client', 'the account')) ?></h4>
										</div>
										<div class="col-2 account-edit">
											<!-- <button class="button-account-edit" onclick="account_edit()">
										<i class="fa  fa-pencil"></i>
										تعديل الحساب
										</button> -->
											<button class="button-account-save-edit" onclick="account_save_edit()" style="display:block;">
												<i class="fa  fa-check  "></i>
												حفظ التعديلات
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-12 add-logo-account">
											<?= $enc->html($this->translate('client', 'Store logo')) ?>
											<div>
												<div class="containerPersonalImag"> 
													<div class="avatar-edit">
														<input type="file" id="imageUpload2" name="icon" accept=".png, .jpg, .jpeg"/>
														<label for="imageUpload2"></label>
													</div>
													<div class="avatar-preview">
														<div id="imagePreview2" style="background-image: url(<?= auth()->user()->icon ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShI303PrApWb4AdQYGoqctcZZaC6nluhN8fcG5911GGPDXSWjY8YmJF4penid5FKYRvx0&usqp=CAU' ?>);">
														</div>
													</div>
													<div class="text-danger mt-1"><?= $this->get('errors')->first('icon') ?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6  my-1 mt-3">
											<label><?= $enc->html($this->translate('client', 'Full Name')) ?></label>
											<input type="text" name="name" class="form-control" value="<?= auth()->user()->name ?>" placeholder=" <?= $enc->html($this->translate('client', 'Full Name')) ?>">
											<div class="text-danger mt-1"><?= $this->get('errors')->first('name') ?></div>
										</div>
										<div class="col-md-6 my-1 mt-3">
											<label><?= $enc->html($this->translate('client', 'E-mail')) ?></label>
											<input type="email" class="form-control text-right" disabled value="<?= auth()->user()->email ?>" placeholder="<?= $enc->html($this->translate('client', 'E-mail')) ?>">
											<div class="text-danger mt-1"><?= $this->get('errors')->first('email') ?></div>
										</div>
										<div class="col-md-6 my-1 mt-3">
											<label><?= $enc->html($this->translate('client', 'Mobile number')) ?></label>
											<div>
												<input type="tel" name="phone" class="form-control input-tel" value="<?= auth()->user()->phone ?>">
												<div class="text-danger mt-1"><?= $this->get('errors')->first('phone') ?></div>
											</div>
										</div>
										<div class="col-md-6  my-1 mt-3">
											<label><?= $enc->html($this->translate('client', 'City')) ?></label>
											<select class="form-control select" name="city">
												<option disabled> <?= $enc->html($this->translate('client', 'City')) ?></option>
												<option value="غزة" class="" <?php if (auth()->user()->city == 'غزة') : ?> selected <?php endif ?>>غزة</option>
												<option value="الوسطى" class="" <?php if (auth()->user()->city == 'الوسطى') : ?> selected <?php endif ?>>الوسطى</option>
												<option value="الشمال" class="" <?php if (auth()->user()->city == 'الشمال') : ?> selected <?php endif ?>>الشمال</option>
												<option value="رفح" class="" <?php if (auth()->user()->city == 'رفح') : ?> selected <?php endif ?>>رفح</option>
											</select>
											<div class="text-danger mt-1"><?= $this->get('errors')->first('city') ?></div>
										</div>
										<div class="col-md-12 my-1 mt-3">
											<label><?= $enc->html($this->translate('client', 'address')) ?></label>
											<input type="text" name="address1" value="<?= auth()->user()->address1 ?>" class="form-control" placeholder="<?= $enc->html($this->translate('client', 'Example: Next to Palestine School')) ?>">
											<div class="text-danger mt-1"><?= $this->get('errors')->first('address1') ?></div>
										</div>
										<!-- <div class="col-md-6 my-1 mt-3">
										<label>كلمة المرور</label>
										<div class="input-icon ">
										<input type="text" class="form-control" placeholder="كلمة المرور">
										<i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
										</div>
									</div> -->
										<div class="col-md-12 my-1 mt-3">
											<label>إسم المتجر</label>
											<input type="text" class="form-control" name="store_label" value="<?= auth()->user()->store_label ?>" placeholder="اسم المتجر" required>
											<div class="text-danger mt-1"><?= $this->get('errors')->first('store_label') ?></div>
										</div>
										<div class="col-md-12 my-1 mt-3">
											<label><?= $enc->html($this->translate('client', 'Brief')) ?></label>
											<textarea rows="3" type="text" name="summary" class="form-control" placeholder="<?= $enc->html($this->translate('client', 'Abstract')) ?>" required><?= auth()->user()->summary ?></textarea>
											<div class="text-danger mt-1"><?= $this->get('errors')->first('summary') ?></div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 add-logo-account mt-4">
											<div class="Products-Sub mx-4">
												<label><?= $enc->html($this->translate('client', 'Profile Pictures')) ?></label>
												<br>
												<div class="container" style="margin-top: 20px;">
													<div class="row">
														<div class="col-sm-2 imgUp">
															<div class="imagePreview"></div>
															<label class="btn btn-primary">
																<span><?= $enc->html($this->translate('client', 'upload photo')) ?></span>
																<input type="file" name="summary_pics[0]" class="uploadFile img" accept=".png, .jpg, .jpeg" style="width:143px;height:20px;overflow: hidden;">
															</label>
														</div>
														<i class="fa fa-plus summary_img"></i>
													</div>
													<div class="text-danger mt-1"><?= $this->get('errors')->first('summary_pics.*') ?></div>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- <div class="row mt-5 mb-5">
								<div class="col-6">
									<h4> كلمة المرور</h4>
									<button class="button-password-change" onclick="password_change()">
									<i class="fa  fa-pencil"></i>
									تغير كلمة المرور
									</button>
								</div>
								<div class="col-6 password-edit">
									<button class="button-password-edit" onclick="password_edit()">
									<i class="fa  fa-pencil"></i>
									تغير كلمة المرور
									</button>
									<button class="button-password-save-edit"  onclick="password_save_edit()">
									<i class="fa  fa-check  "></i>
									حفظ التغير
									</button>
								</div>
								<div class="col-md-6 my-1 input-password ">
									<label> كلمة المرور الحالية</label>
									<div class="input-icon ">
									<input type="text" class="  form-control" placeholder="أدخل كلمة المرور الحالية">
									<i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
									</div>
								</div>
								<div class="col-md-6 my-1 input-password">
									<label> كلمة المرور الجديدة</label>
									<div class="input-icon ">
									<input type="text" class="  form-control" placeholder="أدخل كلمة المرور الجديدة">
									<i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
									</div>
								</div>
								<div class="col-md-6 my-1 input-password">
									<label> تأكيد كلمة المرور الجديدة</label>
									<div class="input-icon ">
									<input type="text" class="  form-control" placeholder="تأكيد كلمة المرور الجديدة">
									<i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
									</div>
								</div>
							</div> -->
							</div>
						</div>
					</div>
					<!-- /.col-md-8 -->
				</div>
			</div>
		</div>
	<?php endif ?>











	<!---------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------
---------------------------------IF USER--------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------>








	<?php if (auth()->user()->merchant == false) : ?>
		<!-- container  -->
		<div class="bigen-container-shop-data mb-3 ">
			<!-- Breadcrumbs -->
			<div class="container">
				<div class="breadcrumbs ">
					<ul>
						<li><a href="<?= airoute('aimeos_home', ['site' => 'default']) ?>"><?= $enc->html($this->translate('client', 'Main')) ?></a></li>
						<li><a href="/<?= app()->getLocale() . '/profile/' . app('aimeos.context')->get()->locale()->getSiteItem()->getCode() ?>"><i class="fa fa-angle-left" aria-hidden="true"></i><?= $enc->html($this->translate('client', 'Profile personly')) ?></a></li>
					</ul>
				</div>
			</div>
			<!--  shop profile-->
			<div class="container  mb-5 ">
				<div class="row 3 bg-User-profile">
					<div class="col-md-6 user-profile-deital">
						<div class="logo-user">
							<img src="<?= $enc->attr(auth()->user()->icon) ?>">
						</div>
						<div class="shop_details">
							<div class="shop-title"><?= auth()->user()->name ?></div>
							<div class="shop-sub-title">
								<!-- <span class="fa fa-map-marker"></span> -->
								<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
								<span class="shop-addres "><?= auth()->user()->city ?> - <?= auth()->user()->address1 ?></span>
							</div>
						</div>
					</div>
					<div class="col-lg-6 shop-profile-btn ">
						<div class="mt-10px">
							<form action="<?= airoute('logout') ?>" method="POST">
								<?= $this->csrf()->formfield(); ?>
								<button type="submit" class="btn-Sign-out round mt-n13">
									<?= $enc->html($this->translate('client', 'sign out')) ?>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row  ">
					<div class="col-md-2  ">
						<ul class="tab-section nav nav-pills flex-column" id="myTab" role="tablist">
							<li class="nav-item ">
								<a class="nav-link active li-radius-top d-flex" data-toggle="tab" href="#Orders" role="tab" aria-controls="Orders" aria-selected="true">
									<div class="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
											<g id="bag-timer" transform="translate(-364 -188)">
												<path id="Vector" d="M16.8,6.962a4.625,4.625,0,0,0-3.08-1.32v-.76A4.891,4.891,0,0,0,8.363.022a5.147,5.147,0,0,0-4.4,5.04v.58a4.625,4.625,0,0,0-3.08,1.32,4.4,4.4,0,0,0-.83,3.52l.7,5.57c.21,1.95,1,3.95,5.3,3.95h5.58c4.3,0,5.09-2,5.3-3.94l.7-5.59A4.383,4.383,0,0,0,16.8,6.962ZM8.5,1.412a3.485,3.485,0,0,1,3.83,3.47v.7H5.353v-.52A3.761,3.761,0,0,1,8.5,1.412Zm.34,15.17a3.79,3.79,0,1,1,3.79-3.79A3.794,3.794,0,0,1,8.843,16.582Z" transform="translate(367.156 189.998)" fill="#fff" />
												<path id="Vector-2" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75A.755.755,0,0,1,2.006,0a.741.741,0,0,1,.74.75v1.5a.751.751,0,0,1-.36.64l-1.25.75A.794.794,0,0,1,.746,3.75Z" transform="translate(374.254 200.83)" fill="#fff" />
												<path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" transform="translate(388 212) rotate(180)" fill="none" opacity="0" />
											</g>
										</svg>
									</div>
									<span class="mt-2 mr-2"><?= $enc->html($this->translate('client', 'Orders')) ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link li-radius-top d-flex" data-toggle="tab" href="#Products" role="tab" aria-controls="home" aria-selected="true">
									<div class="icon">
										<svg id="Location" xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20">
											<path id="Location-2" data-name="Location" d="M8.5,20a1.358,1.358,0,0,1-.734-.247,21.513,21.513,0,0,1-5.54-5.141A10.384,10.384,0,0,1,0,8.318,8.168,8.168,0,0,1,2.5,2.434,8.53,8.53,0,0,1,8.493,0,8.423,8.423,0,0,1,17,8.318a10.39,10.39,0,0,1-2.23,6.294,21.92,21.92,0,0,1-5.541,5.141A1.319,1.319,0,0,1,8.5,20ZM8.493,5.777a2.8,2.8,0,0,0-2.8,2.8,2.712,2.712,0,0,0,.821,1.954,2.823,2.823,0,0,0,4.79-1.954,2.824,2.824,0,0,0-2.813-2.8Z" transform="translate(0 0)" fill="#525457" />
										</svg>
									</div>
									<span class="mt-2 mr-2"><?= $enc->html($this->translate('client', 'Addresses')) ?></span>
								</a>
							</li>
							<li class="nav-item ">
								<a class="nav-link  li-radius-bottom d-flex " data-toggle="tab" href="#users" role="tab" aria-controls="home" aria-selected="true">
									<div class="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 20">
											<path id="Fill_1" data-name="Fill 1" d="M0,3.4c0,2.72,3.662,3.425,8,3.425,4.315,0,8-.68,8-3.4S12.339,0,8,0C3.685,0,0,.68,0,3.4Z" transform="translate(0 13.174)" fill="#525457" />
											<path id="Fill_4" data-name="Fill 4" d="M5.294,10.583A5.292,5.292,0,1,0,0,5.291a5.274,5.274,0,0,0,5.294,5.292" transform="translate(2.706)" fill="#525457" />
										</svg>
									</div>
									<span class="mt-2 mr-2"><?= $enc->html($this->translate('client', 'the account')) ?></span>
								</a>
							</li>
						</ul>
					</div>
					<!-- /.col-md-4 -->
					<div class="col-md-10 tab-div">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active " id="Orders" role="tabpanel" aria-labelledby="home-tab">
								<h4><?= $enc->html($this->translate('client', 'Orders')) ?></h4>
								<div class="tab_orders">
									<div class="row">
										<div class="col">
											<div class="tabs_container">
												<ul class="tabs d-flex align-items-md-center justify-content-center">
													<li class="tab active" data-active-tab="tab_Pending_orders"><span>قيد الإنتظار</span></li>
													<li class="tab" data-active-tab="tab_current_orders"><span>حالية</span></li>
													<li class="tab" data-active-tab="tab_Completed_orders"><span>مكتملة</span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row mx-1 mt-n13">
										<?php if (!$this->get('historyItems', map())->isEmpty()) : ?>
											<div id="tab_Pending_orders" class="tab_container active">
												<?php foreach ($this->get('historyItems', []) as $id => $orderItem) : ?>
													<?php if ($orderItem['order.statusdelivery'] == -1) : ?>
														<a href="<?= route('front.mrchnt.order.show', ['locale' => app()->getLocale(), 'id' => $orderItem->getBaseItem()->getId()]) ?>">
															<div class="row reviews_col">
																<div class="col-8 details_user_orders">
																	<div class="reviews-User-profile-img">
																		<?php if (count($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort()) > 1) : ?>
																			<img src="<?= asset('front/images/icon/Group 10937.svg') ?>">
																		<?php else : ?>
																			<img src="<?= DB::table('users')->where('siteid', $orderItem->getBaseItem()->getProducts()[0]['order.base.product.siteid'])->first()->icon ?? '' ?>">
																		<?php endif ?>
																	</div>
																	<div class="review">
																		<div class="user_name">
																			<?php foreach ($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort() as $vendor => $value) : ?>
																				<?= $vendor  ?> &nbsp;
																			<?php endforeach  ?>
																		</div>
																		<div class="review_date">
																			<!-- <i class="fa fa-map-marker"></i> -->
																			<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
																			غزة
																		</div>
																		<div class="review_date">#437952</div>
																		<div class="review_date">
																			<img src="<?= asset('front/images/icon/box-time.svg') ?>" id="box-time">
																			<?= date('d/m/y h:i A', strtotime($orderItem['order.ctime'])) ?>
																			<!-- <span class="shop-addres pr-sa">AM10:30	</span> -->
																		</div>
																	</div>
																</div>
																<div class="col-4 details_button_orders">
																	<div class="button-Pending-order">
																		<button>
																			<?= $enc->html($this->translate('client', 'pending')) ?>
																		</button>
																	</div>
																	<div class="button-details-order  mt-3">
																		<button>
																			<?= $enc->html($this->translate('client', 'details')) ?>
																		</button>
																	</div>
																</div>
															</div>
														</a>
													<?php endif ?>
												<?php endforeach ?>
											</div>

											<div id="tab_current_orders" class="tab_container ">
												<?php foreach ($this->get('historyItems', []) as $id => $orderItem) : ?>
													<?php if ($orderItem['order.statusdelivery'] == 2) : ?>
														<a href="<?= route('front.mrchnt.order.show', ['locale' => app()->getLocale(), 'id' => $orderItem->getBaseItem()->getId()]) ?>">
															<div class="row reviews_col">
																<div class="col-8 details_user_orders">
																	<div class="reviews-User-profile-img">
																		<?php if (count($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort()) > 1) : ?>
																			<img src="<?= asset('front/images/icon/Group 10937.svg') ?>">
																		<?php else : ?>
																			<img src="<?= DB::table('users')->where('siteid', $orderItem->getBaseItem()->getProducts()[0]['order.base.product.siteid'])->first()->icon ?? '' ?>">
																		<?php endif ?>
																	</div>
																	<div class="review">
																		<div class="user_name">
																			<?php foreach ($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort() as $vendor => $list) : ?>
																				<?= $vendor  ?> &nbsp;
																			<?php endforeach  ?>
																		</div>
																		<div class="review_date">
																			<!-- <i class="fa fa-map-marker"></i> -->
																			<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
																			غزة
																		</div>
																		<div class="review_date">#437952</div>
																		<div class="review_date">
																			<img src="<?= asset('front/images/icon/box-time.svg') ?>" id="box-time">
																			<?= date('d/m/y h:i A', strtotime($orderItem['order.ctime'])) ?>
																			<!-- <span class="shop-addres pr-sa">AM10:30	</span> -->
																		</div>
																	</div>
																</div>
																<div class="col-4 details_button_orders">
																	<div class="button-proccess-order">
																		<button>
																			<?= $enc->html($this->translate('client', 'Being Processed')) ?>
																		</button>
																	</div>
																	<div class="button-details-order  mt-3">
																		<button>
																			<?= $enc->html($this->translate('client', 'details')) ?>
																		</button>
																	</div>
																</div>
															</div>
														</a>

													<?php endif ?>
												<?php endforeach ?>
											</div>

											<div id="tab_Completed_orders" class="tab_container ">
												<?php foreach ($this->get('historyItems', []) as $id => $orderItem) : ?>
													<?php if ($orderItem['order.statusdelivery'] == 4) : ?>
														<a href="<?= route('front.mrchnt.order.show', ['id' => $orderItem->getBaseItem()->getId(), 'locale' => app()->getLocale()]) ?>">
															<div class="row reviews_col">
																<div class="col-8 details_user_orders">
																	<div class="reviews-User-profile-img">
																		<?php if (count($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort()) > 1) : ?>
																			<img src="<?= asset('front/images/icon/Group 10937.svg') ?>">
																		<?php else : ?>
																			<img src="<?= DB::table('users')->where('siteid', $orderItem->getBaseItem()->getProducts()[0]['order.base.product.siteid'])->first()->icon ?? '' ?>">
																		<?php endif ?>
																	</div>
																	<div class="review">
																		<div class="user_name">
																			<?php foreach ($orderItem->getBaseItem()->getProducts()->groupBy('order.base.product.vendor')->ksort() as $vendor => $list) : ?>
																				<?= $vendor  ?> &nbsp;
																			<?php endforeach  ?>
																			<!-- <button data-toggle="modal" class="vendor-rating-btn" data-id="<?= $orderItem->getBaseItem()->getProducts()[0]->getSiteId() ?>" data-orderid="<?= $orderItem['order.id'] ?>" data-target="#myModal" style="display: inline; margin-right: 20px;  border: none;background-color: #FCA120; color: white; padding: 5px 10px 5px 20px; font-size: 12px ; border-radius: 15px;">
																						<svg style="height: 12px;margin-left: 10px;" xmlns="http://www.w3.org/2000/svg" width="21.032" height="20.023" viewBox="0 0 21.032 20.023">
																							<g id="Star" transform="translate(0.516 0.5)">
																								<path id="Star-2" data-name="Star" d="M15.919,11.82a1.1,1.1,0,0,0-.319.97l.889,4.92a1.08,1.08,0,0,1-.45,1.08,1.1,1.1,0,0,1-1.17.08L10.44,16.56a1.131,1.131,0,0,0-.5-.131H9.669a.812.812,0,0,0-.27.09L4.969,18.84a1.168,1.168,0,0,1-.71.11,1.112,1.112,0,0,1-.89-1.271l.89-4.92a1.119,1.119,0,0,0-.319-.979L.329,8.28A1.08,1.08,0,0,1,.06,7.15,1.123,1.123,0,0,1,.949,6.4l4.97-.721A1.112,1.112,0,0,0,6.8,5.07L8.989.58a1.041,1.041,0,0,1,.2-.27l.09-.07A.671.671,0,0,1,9.44.11L9.549.07,9.719,0h.421a1.119,1.119,0,0,1,.88.6l2.219,4.47a1.111,1.111,0,0,0,.83.609l4.97.721a1.134,1.134,0,0,1,.91.75,1.086,1.086,0,0,1-.29,1.13Z" transform="translate(0 0)" fill="#fff" stroke="rgba(0,0,0,0)" stroke-width="1" />
																							</g>
																						</svg>
																						تقييم التاجر
																					</button> -->
																		</div>
																		<div class="review_date">
																			<!-- <i class="fa fa-map-marker"></i> -->
																			<img src="<?= asset('front/images/icon/Location.svg') ?>" id="Location">
																			غزة
																		</div>
																		<div class="review_date">#437952</div>
																		<div class="review_date">
																			<img src="<?= asset('front/images/icon/box-time.svg') ?>" id="box-time">
																			<?= date('d/m/y h:i A', strtotime($orderItem['order.ctime'])) ?>
																			<!-- <span class="shop-addres pr-sa">AM10:30	</span> -->
																		</div>
																	</div>
																</div>
																<div class="col-4 details_button_orders">
																	<div class="button-completed-order">
																		<button>
																			مكتمل
																		</button>
																	</div>
																	<div class="button-details-order  mt-3">
																		<button>
																			تفاصيل
																		</button>
																	</div>
																</div>
															</div>
														</a>

													<?php endif ?>
												<?php endforeach ?>
											</div>
										<?php endif ?>
									</div>
								</div>
							</div>

							<div class="tab-pane fade " id="Products" role="tabpanel" aria-labelledby="Products-tab">
								<div id="Div-All-Adrees">
									<div class="row">
										<div class="col-6">
											<h4><?= $enc->html($this->translate('client', 'Addresses')) ?></h4>
										</div>
										<div class="col-6 add_Products">
											<a href="<?= airoute('profile.address.add') ?>" class="button-add-Products-new">
												<i class="fa fa-plus"></i>
												<?= $enc->html($this->translate('client', 'Add a new title')) ?>
											</a>
										</div>
									</div>
									<?php foreach ($this->get('user_addresses') as $pos => $addr) : ?>
										<div class="row Address_col">
											<div class="col-md-8 details_user_addres">
												<div class="icon-addres">
													<svg xmlns="http://www.w3.org/2000/svg" width="24.893" height="24" viewBox="0 0 24.893 29.33">
														<g id="Location" transform="translate(1 1)">
															<path id="Path_33958" d="M0,11.407a11.446,11.446,0,0,1,22.893.078v.13c-.078,4.109-2.372,7.907-5.185,10.876A30.087,30.087,0,0,1,12.354,26.9a1.387,1.387,0,0,1-1.815,0,29.543,29.543,0,0,1-7.531-7.052A14.648,14.648,0,0,1,0,11.446Z" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
															<circle id="Ellipse_740" cx="3.669" cy="3.669" r="3.669" transform="translate(7.777 7.959)" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
														</g>
													</svg>
												</div>
												<div class="details_addres">
													<div class="addres_name">
														<?= $addr->firstname . ' ' ?> <?= $addr->lastname ?>
														<?php if ($addr->default == 1) : ?>
															<div class="status-name-addres">الإفتراضي</div>
														<?php endif ?>
													</div>
													<div class="addres_number"><?= $addr->telephone ?></div>
													<div class="addres">
														<!-- <img src="<?= $enc->attr($this->content('front/images/icon/pals.png')) ?>"> -->
														<span><?= aitrans($addr->countryid, [], 'country')?></span>
														<span class="shop-addres pr-sa"><?= $addr->city ?></span>
														<span class="shop-addres pr-sa"><?= $addr->address1 ?></span>
														<span class="shop-addres pr-sa"><?= $addr->postal ?></span>
													</div>
												</div>
											</div>
											<div class="col-md-4 details_button_addres">
												<div class="button-addres ">
													<a href="<?= airoute('profile.address.edit', ['id' => $addr->id]) ?>" class="button-Products-edit">
														<i class="fa  fa-pencil"></i>
														تعديل
													</a>
													<button class="button-Products-delete delete-address" data-pos="<?= $addr->position ?>">
														<i class="fa fa-trash"></i>
														<?= $enc->html($this->translate('client', 'Delete')) ?>
													</button>
												</div>
											</div>
										</div>
									<?php endforeach ?>
								</div>
							</div>

							<div class="tab-pane fade " id="users" role="tabpanel" aria-labelledby="users-tab">
								<form method="POST" action="<?= airoute('front.usr.updateProfile', ['locale' => 'en']) ?>" method="POST" enctype="multipart/form-data">
									<?= $this->csrf()->formfield() ?>
									<input type="hidden" name="usid" value="<?= auth()->user()->id ?>">
									<div class="row">
										<div class="col-6">
											<h4><?= $enc->html($this->translate('client', 'the account')) ?></h4>
										</div>
										<div class="col-6 account-edit">
											<button class="button-account-edit" onclick="account_edit()">
												<i class="fa  fa-pencil"></i>
												تعديل الحساب
											</button>
											<button type="submit" class="button-account-save-edit" onclick="account_save_edit()">
												<i class="fa  fa-check  "></i>
												حفظ التعديلات
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-12 add-logo-account">
											<label for="profile_img">
												الصورة الشخصية
												<div>
													<div class="containerPersonalImag">
														<div class="avatar-edit">
															<input type='file' name="icon" id="imageUpload3" accept=".png, .jpg, .jpeg" />
															<label for="imageUpload3"></label>
														</div>
														<div class="avatar-preview">
															<div id="imagePreview3" style="background-image: url(<?= auth()->user()->icon ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShI303PrApWb4AdQYGoqctcZZaC6nluhN8fcG5911GGPDXSWjY8YmJF4penid5FKYRvx0&usqp=CAU' ?>);">
															</div>
														</div>
													</div>
												</div>
											</label>
											<input type="file" id="profile_img" style="display: none;" name="profile_pic">
											<div class="text-danger mt-1"><?= $this->get('errors')->first('email') ?></div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6  my-1">
											<label><?= $enc->html($this->translate('client', 'Full Name')) ?></label>
											<input type="text" class="form-control" name="name" placeholder=" <?= $enc->html($this->translate('client', 'Full Name')) ?>" value="<?= auth()->user()->name ?>" required>
											<div class="text-danger mt-1"><?= $this->get('errors')->first('name') ?></div>
										</div>
										<div class="col-md-6  my-1">
											<label><?= $enc->html($this->translate('client', 'E-mail')) ?></label>
											<input type="text" class="form-control" disabled placeholder=" <?= $enc->html($this->translate('client', 'E-mail')) ?>" value="<?= auth()->user()->email ?>" required>
										</div>
										<div class="col-md-6  my-1">
											<label><?= $enc->html($this->translate('client', 'Mobile number')) ?></label>
											<div>
												<input type="tel" name="phone" class="form-control input-tel" value="<?= auth()->user()->phone ?>" required>
												<div class="text-danger mt-1"><?= $this->get('errors')->first('phone') ?></div>
											</div>
										</div>
										<div class="col-md-6  my-1">
											<label><?= $enc->html($this->translate('client', 'City')) ?></label>
											<select class="form-control select" name="city">
												<option selected disabled> <?= $enc->html($this->translate('client', 'City')) ?></option>
												<option value="غزة" class="" <?php if (auth()->user()->city == 'غزة') : ?> selected <?php endif ?>>غزة</option>
												<option value="الوسطى" class="" <?php if (auth()->user()->city == 'الوسطى') : ?> selected <?php endif ?>>الوسطى</option>
												<option value="الشمال" class="" <?php if (auth()->user()->city == 'الشمال') : ?> selected <?php endif ?>>الشمال</option>
												<option value="رفح" class="" <?php if (auth()->user()->city == 'رفح') : ?> selected <?php endif ?>>رفح</option>
											</select>
											<div class="text-danger mt-1"><?= $this->get('errors')->first('city') ?></div>
										</div>
										<div class="col-md-12 my-1 ">
											<label><?= $enc->html($this->translate('client', 'address')) ?></label>
											<input type="text" class="form-control" name="address1" placeholder="<?= $enc->html($this->translate('client', 'Example: Next to Palestine School')) ?>" value="<?= auth()->user()->address1 ?>" required>
											<div class="text-danger mt-1"><?= $this->get('errors')->first('address1') ?></div>
										</div>
									</div>
								</form>
								<!-- <div class="row mt-5 mb-5">
							<div class="col-6">
								<h4> كلمة المرور</h4>
								<button class="button-password-change" onclick="password_change()">
								<i class="fa  fa-pencil"></i>
								تغير كلمة المرور
								</button>
							</div>
							<div class="col-6 password-edit">
								<button class="button-password-edit" onclick="password_edit()">
								<i class="fa  fa-pencil"></i>
								تغير كلمة المرور
								</button>
								<button class="button-password-save-edit"  onclick="password_save_edit()">
								<i class="fa  fa-check  "></i>
								حفظ التغير
								</button>
							</div>
							<div class="col-md-6 my-1 input-password ">
								<label> كلمة المرور الحالية</label>
								<div class="input-icon ">
								<input type="text" class="  form-control" placeholder="أدخل كلمة المرور الحالية">
								<i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
								</div>
							</div>
							<div class="col-md-6 my-1 input-password">
								<label> كلمة المرور الجديدة</label>
								<div class="input-icon ">
								<input type="text" class="  form-control" placeholder="أدخل كلمة المرور الجديدة">
								<i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
								</div>
							</div>
							<div class="col-md-6 my-1 input-password">
								<label> تأكيد كلمة المرور الجديدة</label>
								<div class="input-icon ">
								<input type="text" class="form-control" placeholder="تأكيد كلمة المرور الجديدة">
								<i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
								</div>
							</div>
						</div> -->
							</div>
						</div>
					</div>
					<!-- /.col-md-8 -->
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div style="z-index: 9999;" class="modal fade" id="myModalNew" tabindex="-6" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header" style="border-bottom: 0 !important;">
						<span class="w-100 mt-5 mr-5" style="text-align: center; font-size: 15px;">تقيــــم المنتج والمتجـــر</span>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div style="padding:0px 20px ;">
						<div>
							<div class="d-flex justify-content-center">
								<img src="{{asset('front/images/succesfull.gif')}}" alt="" style="width: 200px;">
							</div>
							<label class="d-block w-100 mt-2 mb-1" style="text-align: center; font-weight: bolder;">
								<?= $enc->html($this->translate('client', 'Successfully evaluated')) ?>
							</label>
							<label class="d-block w-100 mt-1 mb-5" style="text-align: center; font-weight: 100;">
								<?= $enc->html($this->translate('client', 'Thank you for your review. We wish you a pleasant experience')) ?>
							</label>
						</div>
					</div>
					<button id="agree" type="button" style="margin: 20px 70px ; border-radius: 17px; color: black; background-color:#F5F6F6 ; border: none;" class="btn btn-secondary agree" data-dismiss="modal">موافق</button>
					<style>
						button#agree:hover {
							background-color: #d2f3f3 !important;
						}

						button#send:hover {
							background-color: #8f101b !important;
						}
					</style>
				</div>
			</div>
		</div>
		<!-- Modal -->
	<?php endif ?>
	<!-- modal -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content  ">
				<div class="modal-header-cust">
					<h5 class="modal-title" id="exampleModalLongTitle"><?= $enc->html($this->translate('client', 'Attention')) ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">
							<i class="fa fa-times-circle"></i>
						</span>
					</button>
				</div>
				<div class="modal-body text-center px-4">
					<div class="form-group text-right  mt-2">
						<?= $enc->html($this->translate('client', 'Are you sure to delete this product')) ?>
					</div>
					<div class="form-group send-masg-shop  font-weight-bold mt-5">
						<button id="confirm-del-button" type="button" value="1" class="btn btn-danger" data-dismiss="modal" data-toggle="modal">
							<?= $enc->html($this->translate('client', 'Delete')) ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="overlay"></div>
<?php endif ?>