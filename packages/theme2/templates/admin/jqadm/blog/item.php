<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2022
 */

$selected = function( $key, $code ) {
	return ( $key === $code ? 'selected="selected"' : '' );
};
 
$enc = $this->encoder();
$blog = $this->get('blog');
if($blog){
	$blog_id = $blog->id;
	$blog_title = $blog->title;
	$blog_description = $blog->description;
	$blog_status = $blog->status;
	$blog_tag = $blog->tag;
	$blog_writer = $blog->writer;
	$blog_city = $blog->city;
	$blog_country = $blog->country;
	$blog_images = $blog->images;
}else{
	$blog_id = null;
	$blog_title = null;
	$blog_description = null;
	$blog_status = null;
	$blog_tag = null;
	$blog_writer = null;
	$blog_city = null;
	$blog_country = null;
	$blog_images = null;
}
?>
<?php $this->block()->start( 'jqadm_content' ) ?>



<form action="<?= route('admin.blog.store', ['locale' => app()->getLocale()])?>" class="item item-product form-horizontal container-fluid" method="POST" enctype="multipart/form-data">
<?= $this->csrf()->formfield() ?>
<input type="hidden" name="blog_id" value="<?= $blog_id ?>">
	<nav class="main-navbar">
		<h1 class="navbar-brand">
			<span class="navbar-title">Blog</span>
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
										<option value="1" <?php if($blog_status == 1) :?> selected="selected" <?php endif?>>
											Enabled
										</option>
										<option value="2" <?php if($blog_status == 2) :?> selected="selected" <?php endif?>>
											Hidden
										</option>
										<option value="0" <?php if($blog_status == 0) :?> selected="selected" <?php endif?>>
											Disabled
										</option>
										<option value="-1" <?php if($blog_status == -1) :?> selected="selected" <?php endif?>>
											Review
										</option>
										<option value="-2" <?php if($blog_status == -2) :?> selected="selected" <?php endif?>>
											Archived
										</option>
									</select>
									<?= $this->get('errors')->first('status')?>
								</div>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Writer</label> 
								<div class="col-sm-10"><input type="text" required="required" tabindex="1" name="writer" placeholder="" value="<?= $blog_writer?>" class="form-control item-code"></div>
								<?= $this->get('errors')->first('writer')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Tag</label> 
								<div class="col-sm-10"><input type="text" required="required" tabindex="1" name="tag" placeholder="" value="<?= $blog_tag?>" class="form-control item-code"></div>
								<?= $this->get('errors')->first('tag')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Title</label> 
								<div class="col-sm-10"><input type="text" required="required" tabindex="1" name="title" placeholder="" value="<?= $blog_title?>" class="form-control item-code"></div>
								<?= $this->get('errors')->first('title')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Description</label> 
								<div class="col-sm-10"><textarea class="summernote" name="description" required="required" tabindex="1" name="description" rows="10" cols="50"><?= $blog_description?></textarea></div>
								<?= $this->get('errors')->first('description')?>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label">Country</label> 
								<div class="col-sm-10">
									<select required="required" tabindex="1" name="country" class="form-select item-status is-valid">
										<option value="">
											Please select
										</option>
										<option value="فلسطين" <?php if($blog_country == 'فلسطين') :?> selected="selected" <?php endif?> >
											فلسطين
										</option>
										<option value="ماليزيا" <?php if($blog_country == 'ماليزيا') :?> selected="selected" <?php endif?>>
											ماليزيا
										</option>
									</select>
									<?= $this->get('errors')->first('country')?>
								</div>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label">City</label> 
								<div class="col-sm-10">
									<select tabindex="1" name="city" class="form-select item-status is-valid">
										<option value="">
											Please select
										</option>
										<option value="غزة" <?php if($blog_city == 'غزة') :?> selected="selected" <?php endif?>>
											غزة
										</option>
										<option value="خانيونس" <?php if($blog_city == 'خانيونس') :?> selected="selected" <?php endif?>>
											خانيونس
										</option>
										<option value="الشمال" <?php if($blog_city == 'الشمال') :?> selected="selected" <?php endif?>>
											الشمال
										</option>
									</select>
									<?= $this->get('errors')->first('city')?>
								</div>
							</div>
							<div class="form-group row mandatory">
								<label class="col-sm-2 form-control-label help">Images</label> 
								<div class="col-sm-10"><input type="file" tabindex="1" name="images[]" class="form-control item-code" multiple></div>
								<?= $this->get('errors')->first('images')?>
							</div>
							<?php if($blog_images):?>
								<div class="form-group row">
									<label class="col-sm-2 form-control-label help"></label> 
									<div class="col-sm-10">
										<?php foreach(json_decode($blog_images) as $image):?>
											<img src="<?= $image ?>" alt="" style="width: 200px;">
										<?php endforeach?>
									</div>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>


<?php $this->block()->stop() ?>


<?= $this->render( $this->config( 'admin/jqadm/template/page', 'page' ) ) ?>