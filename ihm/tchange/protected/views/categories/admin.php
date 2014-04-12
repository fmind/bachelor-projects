<?php
$this->breadcrumbs=array(
	'Catégories'=>array('admin'),
);
?>

<h1>Gérer les Catégories</h1>

<?php echo CHtml::link('Créer une Catégorie','create'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nom',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
