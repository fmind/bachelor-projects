<?php
$this->breadcrumbs=array(
    'Saisons'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('saison-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des saisons</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/saison/create">Ajouter une saison</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'saison-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOSAISON',
        'DATEDEBS',
        'DATEFINS',
        array(
            'type' => 'html',
            'value' => '"<a href=\'/saison/hebergements/$data->NOSAISON\'>hébergements</a>"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
