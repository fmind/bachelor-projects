<?php $this->pageTitle='Créer un nouveau film' ?>

<?php

$this->breadcrumbs=array(
	'Films' => Yii::app()->createURL('film/admin'),
    'créer'
);

$this->menu=array(
	array('label'=>'Gérer les films', 'url'=>array('admin')),
);
?>

<h1>Création d'un nouveau film</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>