<?php
	$enc = $this->encoder();
	$position = $this->get( 'position' );
	$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
	$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
	$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
	$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );
	$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid'] ) );
?>

<?php foreach( $this->get( 'products', [] ) as $id => $productItem ) : ?>
	<?php
		$params = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'd_pos' => $position !== null ? $position++ : ''], $detailFilter );
		$url = $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig );
	?>
<a href=" ">
	<div class="col-lg-4 mb-5 store-categories">
		<div class="store-categories-details discount">
			<a href="<?= $enc->attr( $url  ) ?>">
				<div class="store-categories-img">
					<?php foreach( $productItem->getRefItems('media') as $media ) : ?>
						<img src="<?= $enc->attr( $this->content( 'aimeos/' . $media->getPreview(), $media->getFileSystem() ) ) ?>">
						<?php break; ?>
					<?php endforeach ?>
				</div>
			</a>
			<div class="favorite favorite_left button-Products-like" data-d_prodid="<?= $productItem->getId()?>" data-d_name="<?= $productItem->getLabel()?>"></div>
			<div class="product_info l-h-product-info">
				<div class="row ">
					<div class="col-6">
					<div class=" text-right">
						<span>
							<?php foreach($productItem->getRefItems('catalog')->getNode() as $item) : ?>
								<?php if($item->status == 1 && $item->level) :?>
									<?= $item->label ?>
								<?php break; endif ?>
							<?php endforeach?>
						</span>
					</div>
					</div>
					<div class="col-6">
					<div class=" text-left">
						<i class="star_rating fa fa-star" aria-hidden="true"></i> 
						<span>
							<?= $productItem->getRating() ?? '0.0'?>
						</span>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 product_title text-right">
						<?= $enc->attr($productItem->getLabel()) ?>
					</div>
				</div>
				<?php foreach( $productItem->getRefItems('price') as $price ) : ?>
					<?php
						/// Price format with price value (%1$s) and currency (%2$s)
						$format['value'] = $this->translate( 'client/code', 'price:' . ( $price->getType() ?: 'default' ), null, 0, false ) ?: $this->translate( 'client', '%1$s %2$s' );
						$currency = $this->translate( 'client', $price->getCurrencyId() );
					?>
					<div class="row ">
						<div class="col-7 p-0 text-right">
							<div class="product_price">
								<?= $enc->html( sprintf( $format['value'], $price->getValue() , $currency ), $enc::TRUST ) ?>
								<?php if($price->getRebate() > 0 ) : ?>
									<span> <?= $enc->html( sprintf( $format['value'], $price->getValue() + ($price->getValue() * $price->getRebate()/100) , $currency ), $enc::TRUST )  ?> </span>
								<?php endif ?>
							</div>
						</div>
						
						<?php if($price->getRebate() != 0 ) : ?>
							<div class="col-5 text-left">
								<div class="product_bubble_decount ">
									<?= $enc->attr($price->getRebate(), 0) . '%' ?> <?= $enc->html( $this->translate( 'admin', 'Discount' ) ) ?>
								</div>
							</div>
						<?php endif ?>
					</div>
					<?php break; ?>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</a>
<?php endforeach ?>


 


