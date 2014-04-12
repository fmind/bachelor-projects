<?php
$this->breadcrumbs=array(
	'Aides'=>array('admin'),
);
?>

<h1>Gérer les Aides</h1>

<?php echo CHtml::link('Créer une Aide','create'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'aides-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'libelle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
