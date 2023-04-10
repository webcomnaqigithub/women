<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();
$controller = $this->config( 'admin/jqadm/url/search/controller', 'Jqadm' );
$action = $this->config( 'admin/jqadm/url/search/action', 'search' );
$config = $this->config( 'admin/jqadm/url/search/config', [] );
$newCntl = $this->config( 'admin/jqadm/url/create/controller', 'Jqadm' );
$newTarget = $this->config( 'admin/jqadm/url/create/target' );
$newAction = $this->config( 'admin/jqadm/url/create/action', 'create' );
$searchParams = $params = $this->get( 'pageParams', [] );
$newConfig = $this->config( 'admin/jqadm/url/create/config', [] );

?>
<?php $this->block()->start( 'jqadm_content' ) ?>

<form method="POST" action="<?= route('admin.slider.delete', ['locale' => app()->getLocale()])?>" data-deleteurl=" " novalidate="novalidate" class="list list-product">
<?= $this->csrf()->formfield() ?>
   <div class="table-responsive">
      <table class="list-items table table-hover table-striped">
         <thead class="list-header">
            <tr>
               <th class="select"></th>
               <th class="product-id">
                  <a tabindex="1" href="" class="sort-asc">ID</a>
               </th>
               <th class="product-status">
                  <a tabindex="1">Header</a>
               </th>
               <th class="product-type">
                  <a tabindex="1">Sub Header</a>
               </th>
               <th class="product-type">
                  <a tabindex="1">Image</a>
               </th>
               <th class="actions"><a href="<?= $enc->attr( $this->url( $newTarget, $newCntl, $newAction, $params, [], $newConfig ) ) ?>" tabindex="1" title="Insert new entry (Ctrl+I)" aria-label="Add" class="btn fa act-add"></a> <a href="#" tabindex="1" title="Columns" class="btn act-columns fa"></a></th>
            </tr>
         </thead>
         <tbody>
			 <?php foreach($this->get('sliders') as $slider) :?>
            <input type="hidden" name="slider_id" value="<?= $slider->id ?>">
				<tr class="list-item ">
               <td class="select"><input type="checkbox" tabindex="1" value="1" class="form-check-input"></td>
               <td class="product-id"><a href="/<?= app()->getLocale()?>/admin/default/jqadm/get/slider/<?= $slider->id?>" tabindex="1" class="items-field"><?= $slider->id ?></a></td>
               <td class="product-status"><a href="/<?= app()->getLocale()?>/admin/default/jqadm/get/slider/<?= $slider->id?>" class="items-field"><?= $slider->header ?></a></td>
               <td class="product-type"><a href="/<?= app()->getLocale()?>/admin/default/jqadm/get/slider/<?= $slider->id?>" class="items-field"><?= $slider->subheader ?></a></td>
               <td class="product-type"><a href="/<?= app()->getLocale()?>/admin/default/jqadm/get/slider/<?= $slider->id?>" class="items-field"><img src="<?= $slider->image ?>" alt="" style="width: 65px;"></a></td>
               <td class="actions"> <button type="submit" tabindex="1" title="Delete this entry" aria-label="Delete" class="btn act-delete fa"></button></td>
				</tr>
			<?php endforeach ?>
         </tbody>
      </table>
   </div>
</form>
<?php $this->block()->stop() ?>

<?= $this->render( $this->config( 'admin/jqadm/template/page', 'page' ) ) ?>
