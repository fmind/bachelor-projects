<?php $this->pageTitle='Modifier le billet : '.$model->titre ?>

<?php

$this->breadcrumbs=array(
	'Billets' => Yii::app()->createURL('billet/admin'),
    'modifier'
);

$this->menu=array(
	array('label'=>'Créer un autre billet', 'url'=>array('create')),
	array('label'=>'Supprimer le billet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Êtes vous sûr de vouloir supprimer ce billet ?')),
	array('label'=>'Gérer les autres billets', 'url'=>array('admin')),
);
?>

<h1>Modifier le billet : <?php echo $model->titre; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>