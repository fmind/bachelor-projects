<?php $this->pageTitle='Billets' ?>

<?php

$this->breadcrumbs=array(
	'Billets' => Yii::app()->createURL('billet/admin'),
    'liste'
);

$this->menu=array(
	array('label'=>'Créer un nouveau billet', 'url'=>array('create')),
);

?>

<h1>Gérer les Billets</h1>

<span>
  Cliquer sur "Voir" pour supprimer des commentaires
</span>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'billet-grid',
    'emptyText' => "Aucun billet n'a été trouvé",
    'summaryText' => '',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'titre',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
