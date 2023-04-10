@extends('base')

@section('aimeos_header')
	<?= $aiheader['catalog/tree'] ?? '' ?>
	<?= $aiheader['basket/mini'] ?? '' ?>
    <?= $aiheader['cms/page'] ?? '' ?>
@stop

@section('aimeos_nav')
	<?= $aibody['catalog/tree'] ?? '' ?>
@stop

@section('aimeos_head')
	<?= $aibody['basket/mini'] ?? '' ?>
@stop

@section('aimeos_body')
    <div class="container-fluid" style="margin-top: 200px;margin-bottom: 200px;">
		<?= $aibody['cms/page'] ?? '' ?>
	</div>
@stop
