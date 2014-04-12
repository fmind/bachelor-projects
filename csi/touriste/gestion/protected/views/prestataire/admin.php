<?php
$this->breadcrumbs=array(
    'Prestataires'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('prestataire-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des prestataires</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/prestataire/create">Ajouter un prestataire</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'prestataire-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOPREST',
        array(
            'name' => 'NOSTAT',
            'value' => '$data->stationRel->NOMSTAT',
        ),
        array(
            'name' => 'NOTYPP',
            'value' => '$data->typePrestRel->NOMTYP',
        ),
        'NOMPREST',
        'TELEPHONEPREST',
        'EMAILPREST',
        array(
            'type' => 'html',
            'value' => '"<a href=\'/prestataire/services/$data->NOPREST\'>services</a>"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
