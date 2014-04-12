<?php
$this->breadcrumbs=array(
	'Sous-Catégories'=>array('admin'),
);
?>

<h1>Gérer les Sous-Catégories</h1>

<?php echo CHtml::link('Créer une Sous-Catégorie','create'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sous-categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nom',
        array('name' => 'categorie', 'value' => '$data->categorieRel->nom', 'filter' => false),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
