<?php
$this->breadcrumbs=array(
	'Aides'=>array('admin'),
	'Créer',
);
?>

<h1>Créer une Aide</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>