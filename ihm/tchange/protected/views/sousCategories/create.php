<?php
$this->breadcrumbs=array(
	'Sous-Catégories'=>array('admin'),
	'Créer',
);
?>

<h1>Créer une Sous-Catégorie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>