<?php
$this->breadcrumbs=array(
	'Aides'=>array('admin'),
	$model->id,
	'Modifier',
);
?>

<h1>Modifier l'Aide #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>