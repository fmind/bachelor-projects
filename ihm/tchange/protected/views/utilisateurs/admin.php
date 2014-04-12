<?php
$this->breadcrumbs=array(
	'Utilisateurs'=>array('admin'),
);
?>

<h1>Gérer les Utilisateurs</h1>

<?php echo CHtml::link('Créer un Utilisateur','create'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'utilisateurs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nom',
		'prenom',
		'login',
		'email',
		'profil',
		'date_creation',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
