<?php
$this->breadcrumbs=array(
    'Réservations'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('reservation-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des réservations</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/reservation/create">Ajouter une réservation</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'reservation-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NORES',
        array(
            'name' => 'NOHEBERG',
            'value' => '$data->hebergementRel->NOHEBERG',
        ),
        'value' => 'demandeRel.clientRel.NOM',
        'MONTANTRES',
        'ETATRES',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
