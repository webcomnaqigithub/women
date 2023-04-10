<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();


?>
<div class="row About"> 
	<?php if($this->get('user')->summary_pics !== null) :?>
		<?php foreach(json_decode($this->get('user')->summary_pics) as $image) :?>
			<div class="col-lg-4 mb-3 ">
				<div class="About-img">
					<img src="<?= $image ?>">
				</div>
			</div>
		<?php endforeach?>
	<?php endif ?>
</div>
<div class="row ">
	<div class="col-lg-7">									 
		<?= $this->get('user')->summary ?? '' ?>
	</div>
</div>
<!-- <div class="row About-More">
</div> -->
<!-- <div class="row">
	<div class="col-lg-7 text-center">
		<button class="btn  btn-About-More btn-outline-light cursor-pointer round">
		المزيد
		</button>
	</div>
</div> -->