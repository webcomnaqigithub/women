<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2022
 */

$selected = function( $key, $code ) {
	return ( $key === $code ? 'selected="selected"' : '' );
};
 
$enc = $this->encoder();
$slider = $this->get('slider');
if($slider){
	$slider_id = $slider->id;
	$slider_status = $slider->status;
	$slider_header = $slider->header;
	$slider_subheader = $slider->subheader;
	$slider_image = $slider->image;
	$slider_link = $slider->link;
	$slider_body = $slider->body;
}else{
	$slider_id = null;
	$slider_status = null;
	$slider_header = null;
	$slider_subheader = null;
	$slider_image = null;
	$slider_link = null;
	$slider_body = null;
}

?>
<?php $this->block()->start( 'jqadm_content' ) ?>



<form action="<?= route('admin.slider.store', ['locale' => app()->getLocale()])?>" class="item item-product form-horizontal container-fluid" method="POST" enctype="multipart/form-data">
<?= $this->csrf()->formfield() ?>
<input type="hidden" name="slider_id" value="<?= $slider_id ?>">
	<nav class="main-navbar">
		<h1 class="navbar-brand">
			<span class="navbar-title">Slider</span>
			<span class="navbar-id"></span>
			<span class="navbar-label">New</span>
			<span class="navbar-site">Default</span>
		</h1>
		<div class="item-actions">
		
			<div class="btn-group">
				<button type="submit" class="btn btn-primary act-save" title="Save entry (Ctrl+S)">
				Save</button>
				<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="sr-only">Toggle dropdown</span>
				</button>
			</div>
		</div>
	</nav>
	<div class="row item-container">
		<div class="col-md-12 item-content tab-content ">
			<div id="basic" class="item-basic tab-pane fade show active g-0" role="tabpanel" aria-labelledby="basic">
				<div class="box">
					<div class="row">
						<div data-data="" class="col-xl-10 block vue ">
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label">Status</label> 
								<div class="col-sm-10">
									<select required="required" tabindex="1" name="status" class="form-select item-status is-valid">
										<option value="">
											Please select
										</option>
										<option value="1" <?php if($slider_status == 1) :?> selected="selected" <?php endif?>>
											Enabled
										</option>
										<option value="2" <?php if($slider_status == 2) :?> selected="selected" <?php endif?>>
											Hidden
										</option>
										<option value="0" <?php if($slider_status == 0) :?> selected="selected" <?php endif?>>
											Disabled
										</option>
										<option value="-1" <?php if($slider_status == -1) :?> selected="selected" <?php endif?>>
											Review
										</option>
										<option value="-2" <?php if($slider_status == -2) :?> selected="selected" <?php endif?>>
											Archived
										</option>
									</select>
									<?= $this->get('errors')->first('status')?>
								</div>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Header</label> 
								<div class="col-sm-10"><input type="text" tabindex="1" name="header" placeholder="" value="<?=$slider_header?>" class="form-control item-code"></div>
								<?= $this->get('errors')->first('header')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Sub Header</label> 
								<div class="col-sm-10"><input type="text" tabindex="1" name="subheader" placeholder="" value="<?=$slider_subheader?>" class="form-control item-code"></div>
								<?= $this->get('errors')->first('tag')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Body</label> 
								<div class="col-sm-10"><input type="text" tabindex="1" name="body" placeholder="" value="<?=$slider_body?>" class="form-control item-code"></div>
								<?= $this->get('errors')->first('title')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Link</label> 
								<div class="col-sm-10"><input type="text" tabindex="1" name="link" placeholder="" value="<?=$slider_link?>" class="form-control item-code"></div>
								<?= $this->get('errors')->first('link')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Image</label> 
								<div class="col-sm-10"><input type="file" tabindex="1" name="image" class="form-control item-code"></div>
								<?= $this->get('errors')->first('image')?>
							</div>
							<?php if($slider_image):?>
								<div class="form-group row  ">
									<label class="col-sm-2 form-control-label"></label> 
									<div class="col-sm-10"><img src="<?=$slider_image?>" alt=""></div>
								</div>
							<?php endif?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>


<?php $this->block()->stop() ?>


<?= $this->render( $this->config( 'admin/jqadm/template/page', 'page' ) ) ?>