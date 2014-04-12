<?php $this->pageTitle='Films' ?>

<?php

$this->breadcrumbs=array(
	'Films' => Yii::app()->createURL('film/admin'),
    'liste'
);

$this->menu=array(
	array('label'=>'Créer un nouveau film', 'url'=>array('create')),
);

?>

<h1>Gérer les Films</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'film-grid',
    'emptyText' => "Aucun film n'a été trouvé",
    'summaryText' => '',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
          'name'=>'image',
          'type'=>'image',
          'value'=>'Yii::app()->baseUrl."/images/films/".$data->id.".jpg"'
        ),
		'titre',
        'date_sortie',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
