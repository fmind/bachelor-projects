<?php
$this->breadcrumbs=array(
	'Catégories'=>array('admin'),
	'Créer',
);
?>

<h1>Créer une Catégorie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>