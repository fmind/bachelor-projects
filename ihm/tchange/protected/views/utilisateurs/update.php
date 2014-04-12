<?php
$this->breadcrumbs=array(
	'Utilisateurs'=>array('admin'),
	$model->id,
	'Modifier',
);
?>

<h1>Modifier l'Utilisateur #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>