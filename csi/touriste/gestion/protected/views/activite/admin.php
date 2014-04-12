<?php
$this->breadcrumbs=array(
    'Activités'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('activite-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des activités</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/activite/create">Ajouter une activité</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'activite-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOACT',
        array(
            'name' => 'NOTYPACT',
            'value' => '$data->typeActRel->NOMTYPACT',
        ),
        'NOMACT',
        array(
            'name' => 'INTERIEUR',
            'value' => '($data->INTERIEUR) ? "oui" : "non"',
        ),
        array(
            'name' => 'ENFANTACT',
            'value' => '($data->ENFANTACT) ? "oui" : "non"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
