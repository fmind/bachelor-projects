<?php
$this->breadcrumbs=array(
    'Services'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('service-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des services</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/service/create">Ajouter un service</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'service-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOSERV',
        'NOMSERVICE',
        array(
            'name' => 'COMPRIS',
            'value' => '($data->COMPRIS) ? "oui" : "non"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
