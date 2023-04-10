<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2021-2022
 */

/* Available data:
 * - pageCmsItem : Cms page item incl. referenced items
 */


$enc = $this->encoder();


?>

<div class="wrapper" id="main">
	<div class="site-content container" id="primary">
		<div role="main" id="content" style="margin-top: 75px;color: #000;margin-bottom: 75px;">
			<style>
				<?= json_decode($this->get('pageCmsItem', [])->getRefItems('text')->first()->getContent())->css ?>
			</style>
			<?php foreach ($this->get('pageContent', []) as $content) : ?>
				<?= $content ?>
			<?php endforeach ?>
		</div>
	</div>
</div>