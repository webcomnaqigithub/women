<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2022
 */

$enc = $this->encoder();

$selectfcn = function( $list, $key, $value ) {
	return ( isset( $list[$key] ) && $list[$key] == $value ? 'selected="selected"' : '' );
};
$product = $this->get('product');


$addr = $this->get( 'addressBilling', [] );
$pos = 0;
/// Date format with year (Y), month (m) and day (d). See http://php.net/manual/en/function.date.php
$dateformat = $this->translate( 'client', 'Y-m-d' );
/// Order status (%1$s) and date (%2$s), e.g. "received at 2000-01-01"
$attrformat = $this->translate( 'client', '%1$s at %2$s' );

?>
<?php if(auth()->user()->merchant == true ) : ?>
	<div class="bigen-container-shop-data mb-3 ">
		<!-- Breadcrumbs -->
		<div class="container">
			<div class="breadcrumbs ">
				<ul>
					<li><a href="<?= airoute('aimeos_home', ['site' => 'default']) ?>"><?= $enc->html( $this->translate( 'client', 'Main' ) ) ?></a></li>
					<li>
						<a href="/<?= app()->getLocale() . '/profile/' . app('aimeos.context')->get()->locale()->getSiteItem()->getCode()?>">
							<i class="fa fa-angle-left" aria-hidden="true"></i><?= $enc->html( $this->translate( 'client', 'Profile personly' ) ) ?>
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
					<h4>تعديل منتج</h4>
					<form action="<?= route('front.mrchnt.product.store', ['locale'=>'en', 'site' => app('aimeos.context')->get(false)->locale()->getSiteItem()->getCode(), 'resource' => 'product']) ?>" method="post" enctype="multipart/form-data" name="EditProductDiv" id="EditProductForm">
						<?= $this->csrf()->formfield() ?>
						<input type="hidden" name="usid" value="<?= app('aimeos.context')->get()->locale()->getSiteItem()->getId()?>">
						<input type="hidden" name="item[product.id]" id="productId" value="<?= $product->getId()?>">
						<input type="hidden" name="item[product.code]" id="productCode" value="<?= $product->getCode()?>">									
						<div class="row Register-input mt-2">
							<div class="col-md-6  my-1">
								<label>إسم المنتج</label>
								<input type="text" name="item[product.label]" class="form-control" id="item_product_label" value='<?= $product->getLabel()?>' required>
								<input type="hidden" name="item[product.type]" value="default">
								<input type="hidden" name="item[product.status]" value="1">
								<div class="text-danger"><?= $this->get('errors')->first('item.product.label') ?></div>
							</div>
							<div class="col-md-6  my-1">
							<label>التصنيف الأساسي</label>
							<input type="hidden" name="category[default-0][product.lists.type]" value="default">
								<select class="form-control select" name='category[default-0][catalog.id]' id="category" required>
									<option disabled >إختر التصنيف الأساسي</option>
									<?php foreach( $this->get( 'categories', map() )->toArray() as $category ) : ?>
										<option value="<?= $category->id ?>"><?= $category->label ?></option>
									<?php endforeach ?>
								</select>
								<div class="text-danger"><?= $this->get('errors')->first('category.default-0.catalog.id') ?></div>
							</div>
							<div class="col-md-6  my-1">
								<label>التصنيف الفرعي</label>
								<input type="hidden" name="category[default-1][product.lists.type]" value="default" >
								<select class="form-control select" id="sub_categories" name='category[default-1][catalog.id]'>
									<option value="<?= $product->getlistItems('catalog')->last()->getRefItem()->getNode()->getId()?>"><?= $product->getlistItems('catalog')->last()->getRefItem()->getNode()->getLabel()?></option>
								</select>
								<div class="text-danger"><?= $this->get('errors')->first('category.default-1.catalog.id') ?></div>
							</div>
							<div class="col-md-6 my-1">
								<label><?= $enc->html( $this->translate( 'client', 'Price in ILS' ) ) ?></label> 
								<div class="input-group">
									<input type="text" class="form-control regxnum" name="price[0][price.value]" aria-label="Text input with dropdown button" value="<?= $product->getListItems('price')->first()->getRefItem()->getValue()?>" id="price" required>
									<input type="hidden" name="price[0][price.status]" value="1">
									<input type="hidden" name="price[0][price.type]" value="default">
									<input type="hidden" name="price[0][price.lists.type]" value="default">
									<input type="hidden" name="price[0][price.taxrates][]" value="0">
									<input type="hidden" name="price[0][price.id]" id="priceid" value="<?= $product->getListItems('price')->first()->getRefItem()->getId()?>">
									<div class="input-group-append">
										<select class="form-control select-input-group-append" name="price[0][price.currencyid]" id="priceCurrency" required>
											<option value="ILS">شيكل</option>
										</select>
									</div>
								</div> 
								<div class="text-danger"><?= $this->get('errors')->first('price.0.price.value') ?></div>
							</div>
							<div class="col-md-6 my-1">
								<label><?= $enc->html( $this->translate( 'client', 'Price in USD' ) ) ?></label>  
								<div class="input-group">
									<input type="text" class="form-control regxnum" name="price[1][price.value]" aria-label="Text input with dropdown button" value="<?= $product->getListItems('price')->last()->getRefItem()->getValue()?>" id="price" required>
									<input type="hidden" name="price[1][price.status]" value="1">
									<input type="hidden" name="price[1][price.type]" value="default">
									<input type="hidden" name="price[1][price.lists.type]" value="default">
									<input type="hidden" name="price[1][price.taxrates][]" value="0">
									<input type="hidden" name="price[1][price.id]" id="priceid" value="<?= $product->getListItems('price')->last()->getRefItem()->getId()?>">
									<div class="input-group-append">
										<select class="form-control select-input-group-append" name="price[1][price.currencyid]" id="priceCurrency" required>
											<option value="USD" selected>دولار</option>
										</select>
									</div>
								</div>
								<div class="text-danger"><?= ($this->get('errors')->first('price.1.price.value')) ?></div>
							</div>
							<div class="col-md-6  my-1">
								<label>الخصم</label>
								<div class="input-group">
									<input type="text" name="price[0][price.rebate]" value="<?= $product->getRefItems('price')->first()->getRebate()?>" class="form-control regxnum" aria-label="Text input with dropdown button" id="rebate">
									<div class="input-group-append">
										<span class="input-group-text input-group-text-cust" >%</span>
									</div>
								</div>
								<div id="rebate_error" class="mt-1 text-danger"></div>
							</div>
							<div class="col-md-6  my-1">
								<label>الكمية</label> 
								<input type="text" class="form-control regxnum" value="<?= $product->getStockItems()->first()['stock.stocklevel'] ?>" name="stock[0][stock.stockdiff]" id="stock">
								<input type="hidden" class="form-control" name="stock[0][stock.stockflag]" value="1">
								<input type="hidden" class="form-control" name="stock[0][stock.id]" id="stockid" value="<?= $product->getStockItems()->first()->getId()?>">
								<div class="text-danger"><?= ($this->get('errors')->first('stock.0.stock.stockdiff]')) ?></div>
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
								<label> المقاسات  المتوفرة</label>
								<input type="hidden" name="characteristic[attribute][0][attribute.type]" value="size" disabled id="size-attribute">
								<div class="group-label-chack">
									<label class="label-chack">
										<input type="radio" name="characteristic[attribute][0][product.lists.refid]" checked value="21" class="card-input-element" />
										<div class="panel panel-default card-input">
											<div class="panel-heading">S</div>
										</div>
									</label>
									<label class="label-chack">
										<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="20"  class="card-input-element" />
										<div class="panel panel-default card-input">
											<div class="panel-heading">M</div>
										</div>
									</label>
									<label class="label-chack">
										<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="19"  class="card-input-element" />
										<div class="panel panel-default card-input">
											<div class="panel-heading">L</div>
										</div>
									</label>
									<label class="label-chack">
										<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="18"  class="card-input-element" />
										<div class="panel panel-default card-input">
											<div class="panel-heading">XL</div>
										</div>
									</label>
									<label class="label-chack">
										<input type="radio" name="characteristic[attribute][0][product.lists.refid]" value="17"  class="card-input-element" />
										<div class="panel panel-default card-input">
											<div class="panel-heading">2XL</div>
										</div>
									</label>
								</div>
							</div>
							<div class="col-md-12  my-1">
							<label>الوصف</label>
								<input type="hidden" name="text[0][product.lists.type]" value="default">
								<input type="hidden" name="text[0][text.status]" value="1">
								<input type="hidden" name="text[0][text.type]" value="long">
								<input type="hidden" name="text[0][text.label]" value="labell">
								<input type="hidden" name="text[0][text.id]" id="textid" value="<?= $product->getRefItems('text')->first()->getId()?>"> 
								<textarea rows="7" type="text" class="form-control" name="text[0][text.content]" id="text" required><?= $product->getRefItems('text')->first()->getContent() ?></textarea>
								<div class="text-danger"><?= $this->get('errors')->first('text.0.text.content') ?></div>
							</div>
							<div id="content_error" class="mt-1 text-danger"></div>
							<div class="col-md-12 my-2 Products-img">
							<div class="Products-Sub mx-4">
								<label>الصور</label>
								<div id="edit_form_images"></div>
								<div class="container" style="margin-top: 20px;" >
									<div class="row">
										<?php foreach($product->getRefItems('media') as $key=>$item) : ?>
											<img src="<?= $item->getPreview()?>" alt="">
											<div class="col-sm-2 imgUp"> 
												<div class="imagePreview d-flex justify-content-center">
													<img src="/aimeos/<?= $item->getPreview()?>" alt="" >
												</div>
												<label class="btn btn-primary">
													<span><?= $enc->html( $this->translate( 'client', 'upload photo' ) ) ?></span> 
													<input type="hidden" name="media[<?= $key?>][media.status]" value="1">
													<input type="hidden" name="media[<?= $key?>][media.type]" value="default">
													<input type="hidden" name="media[<?= $key?>][product.lists.type]" value="default">
													<input type="hidden" name="media[<?= $key?>][media.label]" value="<?= $item->getLabel()?>">
													<input type="hidden" name="media[<?= $key?>][media.id]" value="<?= $item->getId()?>">
													<input type="hidden" name="media[<?= $key?>][media.url]" value="<?= $item->getUrl()?>">
												</label>
												<i class="fa fa-times del"></i>
											</div>
											<?php endforeach?>
										<i class="fa fa-plus imgAdd"></i>
									</div>
								</div>
							</div>
							</div>
							<div id="file_error" class="mt-1 text-danger"></div>
							<div class="col-12 mt-2 Button_Add_New_Products">
							<!-- <button class="button-Products-cancel ml-2">
								<?= $enc->html( $this->translate( 'client', 'Cancel' ) ) ?>
							</button> -->
							<button type="submit" class="button-Products-save mr-2" id="edit-product">
								<i class="fa fa-check"></i>
								حفظ المنتج
							</button>
							</div>
						</div>
					</form>
				</div>
				<!-- /.col-md-8 -->
			</div>
		</div>
	</div>
<?php endif ?>
 
