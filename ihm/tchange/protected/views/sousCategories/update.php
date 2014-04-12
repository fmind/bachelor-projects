<?php
$this->breadcrumbs=array(
	'Sous-Catégories'=>array('admin'),
	$model->id,
	'Modifier',
);
?>

<h1>Modifier la Sous-Catégorie #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>