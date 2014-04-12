<?php
$this->breadcrumbs=array(
    'Demandes'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('demande-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des demandes</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/demande/create">Ajouter une demande</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'demande-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NDEM',
        array(
            'name' => 'NOCLIENT',
            'value' => '$data->clientRel->NOM',
        ),
        array(
            'name' => 'NOTYPH',
            'value' => '$data->typeHebergRel->NOMTYPH',
        ),
        array(
            'name' => 'NOTYPEPREST',
            'value' => '$data->typePrestRel->NOMTYP',
        ),
        array(
            'name' => 'NOSTAT',
            'value' => '$data->stationRel->NOMSTAT',
        ),
        'ETATDEM',
        'DATEDEBUTRES',
        'DATEFINRES',
        'NBPERSRES',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
