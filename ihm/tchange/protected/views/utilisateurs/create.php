<?php
$this->breadcrumbs=array(
	'Utilisateurs'=>array('admin'),
	'Créer',
);
?>

<h1>Créer un Utilisateur</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>