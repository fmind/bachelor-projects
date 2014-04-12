<?php $this->pageTitle='Créer un nouveau billet' ?>

<?php

$this->breadcrumbs=array(
	'Billets' => Yii::app()->createURL('billet/admin'),
    'créer'
);

$this->menu=array(
	array('label'=>'Gérer les billets', 'url'=>array('admin')),
);
?>

<h1>Création d'un nouveau billet</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>