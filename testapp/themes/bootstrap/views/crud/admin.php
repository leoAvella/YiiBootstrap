<?php
$this->breadcrumbs=array(
	'Cruds'=>array('index'),
	'Manage',
);

$this->menu=array(
	array(
		'label' => 'Crud Operations', 'items' => array(
			array('label'=>'List', 'url'=>array('index'), 'icon' => 'list-alt'),
			array('label'=>'Create', 'url'=>array('create'), 'icon' => 'plus'),
		),
	),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle('fast');
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('crud-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cruds</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('EBootstrapGridView', array(
	'id'=>'crud-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'date_created',
		'date_updated',
		array(
			'class'=>'CButtonColumn',
		),
	),
	'pager' => array(
		'class' => 'EBootstrapLinkPager',
		'header' => false,
	),
	'pagerAlign' => 'centered',
	'bordered' => true,
	'striped' => true,
	'condensed' => true,
)); ?>