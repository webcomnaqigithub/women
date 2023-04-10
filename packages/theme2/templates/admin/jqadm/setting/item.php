<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2022
 */

$selected = function( $key, $code ) {
	return ( $key === $code ? 'selected="selected"' : '' );
};
 
$enc = $this->encoder();
 
?>
<?php $this->block()->start( 'jqadm_content' ) ?>



<form action="<?= route('admin.setting.store', ['locale' => app()->getLocale()])?>" class="item item-product form-horizontal container-fluid" method="POST" enctype="multipart/form-data">
<?= $this->csrf()->formfield() ?>
	<nav class="main-navbar">
		<h1 class="navbar-brand">
			<span class="navbar-title">Setting</span>
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
										<option value="1" selected="selected">
											Enabled
										</option>
										<option value="2">
											Hidden
										</option>
										<option value="0">
											Disabled
										</option>
										<option value="-1">
											Review
										</option>
										<option value="-2">
											Archived
										</option>
									</select>
									<?= $this->get('errors')->first('status')?>
								</div>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Slider Image 1</label> 
								<div class="col-sm-10"><input type="file" required="required" tabindex="1" name="slider1" class="form-control item-code" multiple></div>
								<?= $this->get('errors')->first('slider')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Tag</label> 
								<div class="col-sm-10"><input type="text" required="required" tabindex="1" name="tag" placeholder="" value="" class="form-control item-code"></div>
								<?= $this->get('errors')->first('tag')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Title</label> 
								<div class="col-sm-10"><input type="text" required="required" tabindex="1" name="title" placeholder="" value="" class="form-control item-code"></div>
								<?= $this->get('errors')->first('title')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Description</label> 
								<div class="col-sm-10"><textarea class="summernote" name="description" required="required" tabindex="1" name="description" rows="10" cols="50"></textarea></div>
								<?= $this->get('errors')->first('description')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label">Country</label> 
								<div class="col-sm-10">
									<select required="required" tabindex="1" name="country" class="form-select item-status is-valid">
										<option value="">
											Please select
										</option>
										<option value="فلسطين" selected="selected">
											فلسطين
										</option>
										<option value="ماليزيا">
											ماليزيا
										</option>
									</select>
									<?= $this->get('errors')->first('country')?>
								</div>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label">City</label> 
								<div class="col-sm-10">
									<select required="required" tabindex="1" name="city" class="form-select item-status is-valid">
										<option value="">
											Please select
										</option>
										<option value="غزة" selected="selected">
											غزة
										</option>
										<option value="خانيونس">
											خانيونس
										</option>
										<option value="الشمال">
											الشمال
										</option>
									</select>
									<?= $this->get('errors')->first('city')?>
								</div>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Images</label> 
								<div class="col-sm-10"><input type="file" required="required" tabindex="1" name="images[]" class="form-control item-code" multiple></div>
								<?= $this->get('errors')->first('images')?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>


<?php $this->block()->stop() ?>


<?= $this->render( $this->config( 'admin/jqadm/template/page', 'page' ) ) ?>