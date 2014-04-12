<?php
$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	$model->id,
	'Modifier',
);
?>

<h1>Modifier la Catégorie #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>