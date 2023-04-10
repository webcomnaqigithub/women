<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2022
 */


$enc = $this->encoder();


/** client/html/catalog/lists/url/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2014.03
 * @see client/html/catalog/lists/url/controller
 * @see client/html/catalog/lists/url/action
 * @see client/html/catalog/lists/url/config
 */

/** client/html/catalog/lists/url/controller
 * Name of the controller whose action should be called
 *
 * In Model-View-Controller (MVC) applications, the controller contains the methods
 * that create parts of the output displayed in the generated HTML page. Controller
 * names are usually alpha-numeric.
 *
 * @param string Name of the controller
 * @since 2014.03
 * @see client/html/catalog/lists/url/target
 * @see client/html/catalog/lists/url/action
 * @see client/html/catalog/lists/url/config
 */

/** client/html/catalog/lists/url/action
 * Name of the action that should create the output
 *
 * In Model-View-Controller (MVC) applications, actions are the methods of a
 * controller that create parts of the output displayed in the generated HTML page.
 * Action names are usually alpha-numeric.
 *
 * @param string Name of the action
 * @since 2014.03
 * @see client/html/catalog/lists/url/target
 * @see client/html/catalog/lists/url/controller
 * @see client/html/catalog/lists/url/config
 */

/** client/html/catalog/lists/url/config
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
 * @since 2014.03
 * @see client/html/catalog/lists/url/target
 * @see client/html/catalog/lists/url/controller
 * @see client/html/catalog/lists/url/action
 * @see client/html/url/config
 */

// $linkKey = $this->param( 'f_catid' ) ? 'client/html/catalog/tree/url' : 'client/html/catalog/lists/url';
$linkKey = 'client/html/catalog/lists/url';


?>
<div class="col-lg-3 filter-side catalog-filter aimeos" data-jsonurl="<?= $enc->attr( $this->link( 'client/jsonapi/url' ) ) ?>">
<form action="<?= $enc->attr( $this->link( $linkKey, $this->param() ) ) ?>" method="GET" id="product_shopping">
		<div class="sidebar">
			<!-- Elements -->
			<div class="row ">
			<div class="sidebar_section mt-2">
				<ul class="checkboxes">
					<!-- <li><i class="fa fa-square-o" aria-hidden="true"></i><span>تقييم المنتج</span></li>
					<li><i class="fa fa-square-o" aria-hidden="true"></i><span>نقيم البائع</span></li> -->
					<li><i class="fa fa-square-o" aria-hidden="true"></i><span>السعر</span></li>
					<li class="">
						<div class="d-flex price">
							<input type="number" name="f_price" class="input-price form-control " placeholder="من">
							<span class="px-2"> -- </span>
							<input type="number" name="f_price" class="input-price form-control" placeholder="الى">
						</div>
					</li>
				</ul>
			</div>
			</div>
			<!-- SEctions -->
			<div class="row ">
			<div class="sidebar_section">
				<div class="row ">
					<span class="col-9 d-flex justify-content-start sidebar_title">
						<h5>الأقسام</h5>
					</span>
					<span class="col-3 d-flex justify-content-end">
					<i class="fa fa-angle-up"></i>
					</span>
				</div>
				<ul class="checkboxes ">
					<?php foreach (map($this->get('sub_categories'), []) as $item) :?>
						<li>
							<input type="radio" value="<?= $item->id ?>" id="<?= $item->code ?>" name="f_catid" >&nbsp;
							<label for="<?= $item->code?>"><?= $item->label ?></label><span class="f-left"></span>
						</li>
					<?php endforeach?>
					<!-- <input type="hidden" value="e" name="f_name" >  -->
					
				</ul>
			</div>
			</div> 
			<!-- size -->
			<div class="row ">
			<div class="sidebar_section">
				<div class="row ">
					<span class="col-9 d-flex justify-content-start sidebar_title">
						<h5>المقاس</h5>
					</span>
					<span class="col-3 d-flex justify-content-end">
					<i class="fa fa-angle-down"></i>
					</span>
				</div>
				<ul class="checkboxes ">
					<?php foreach (map($this->get('attributes'), []) as $key=>$item) :?>
						<li><input type="radio" name="f_attrid[]"  id="<?= $item->getCode() ?>" value="<?= $key ?>">&nbsp; <label for="<?= $item->getCode()?>"><?= $item->getLabel()?></label></li> 
					<?php endforeach?>
				</ul>
			</div>
			</div>
		</div>
	</form>

</div>
