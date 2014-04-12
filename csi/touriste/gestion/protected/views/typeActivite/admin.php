<?php
$this->breadcrumbs=array(
    'Type Activités'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('type-activite-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des types d'activités</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/typeActivite/create">Ajouter un type d'activité</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'type-activite-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOTYPACT',
        'NOMTYPACT',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
