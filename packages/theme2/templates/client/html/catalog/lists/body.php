<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();
$key = $this->param( 'f_catid' ) ? 'client/html/catalog/tree/url' : 'client/html/catalog/lists/url';


/** client/html/catalog/lists/pagination
 * Enables or disables pagination in list views
 *
 * Pagination is automatically hidden if there are not enough products in the
 * category or search result. But sometimes you don't want to show the pagination
 * at all, e.g. if you implement infinite scrolling by loading more results
 * dynamically using AJAX.
 *
 * @param boolean True for enabling, false for disabling pagination
 * @since 2019.04
 */

 

?>
<div class="col-lg-9">
	<div class="">
		<?= $this->partial(
				$this->get( 'listPartial', 'catalog/lists/items' ),
				array(
					'require-stock' => (int) $this->config( 'client/html/basket/require-stock', true ),
					'basket-add' => $this->config( 'client/html/catalog/lists/basket-add', false ),
					'products' => $this->get( 'listProductItems', map() ),
					'position' => $this->get( 'listPosition' ),
				)
			) ?>
	</div>
</div>

