<?php
$this->breadcrumbs=array(
    'Types de préstations'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('type-prest-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion de types de prestation</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/typePrest/create">Ajouter un type de prestation</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'type-prest-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOTYPP',
        'NOMTYP',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
