<?php $this->pageTitle='Modifier le film : '.$model->titre ?>

<?php

$this->breadcrumbs=array(
	'Films' => Yii::app()->createURL('film/admin'),
    'modifier'
);

$this->menu=array(
	array('label'=>'Créer un autre film', 'url'=>array('create')),
	array('label'=>'Supprimer le film', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Êtes vous sûr de vouloir supprimer ce film ?')),
	array('label'=>'Gérer les autres films', 'url'=>array('admin')),
);
?>

<h1>Modifier le billet : <?php echo $model->titre; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>