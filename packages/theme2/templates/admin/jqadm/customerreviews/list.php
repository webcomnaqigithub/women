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
<style>
   .table-striped>tbody>tr:nth-of-type(odd)>*{
      color: #d0d8f0;
   }
</style>
<?php $this->block()->start( 'jqadm_content' ) ?>

<form method="POST" action="<?= route('admin.review.activate', ['locale' => app()->getLocale()])?>" data-deleteurl=" " novalidate="novalidate" class="list list-product">
   <?= $this->csrf()->formfield() ?>
   <div class="table-responsive">
      <table class="list-items table table-hover table-striped">
         <thead class="list-header">
            <tr>
               <!-- <th class="select"></th> -->
               <th class="product-id"><a tabindex="1" href=" " class="sort-asc">#</a></th>
               <th class="product-status"><a tabindex="1">Name</a></th>
               <th class="product-type"><a tabindex="1">Rating</a></th>
               <th class="product-type"><a tabindex="1">Comment</a></th>
               <th class="actions"><a href="<?= $enc->attr( $this->url( $newTarget, $newCntl, $newAction, $params, [], $newConfig ) ) ?>" tabindex="1" title="Insert new entry (Ctrl+I)" aria-label="Add" class="btn fa act-add"></a> <a href="#" tabindex="1" title="Columns" class="btn act-columns fa"></a></th>
            </tr>
         </thead>
         <tbody> 
			 <?php foreach($this->get('customerreviews') as $key=>$customerreview) :?>
            <input type="hidden" name="review_id" value="<?= $customerreview->id ?>">
				<tr class="list-item" style="color:#d0d8f0">
               <td class="product-id"><?= $key + 1 ?></td>
               <td class="product-id"><?= $customerreview->name ?></td>
               <td class="product-id"><?= $customerreview->rating ?></td>
               <td class="product-id"><?= $customerreview->comment ?></td>
               <!-- <td class="product-status">
                  <a href=" " class="items-field">
                     <div class="fa status-1"></div>
                  </a>
               </td> -->
               <td class="actions"><button type="submit" tabindex="1" title="Block this entry" aria-label="Block" class="btn act-delete fa"></button></td>
				</tr>
			<?php endforeach ?>
         </tbody>
      </table>
   </div>
</form>
<?php $this->block()->stop() ?>

<?= $this->render( $this->config( 'admin/jqadm/template/page', 'page' ) ) ?>
