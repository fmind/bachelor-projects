<?php
$this->breadcrumbs=array(
    'Stations'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('station-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des stations</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/station/create">Ajouter une station</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'station-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOSTAT',
        'NOMSTAT',
        'ADRESSESTAT',
        'TELEPHONESTAT',
        'EMAILSTAT',
        array(
            'type' => 'html',
            'value' => '"<a href=\'/station/activites/$data->NOSTAT\'>activités</a>"',
        ),
        array(
            'type' => 'html',
            'value' => '"<a href=\'/station/particularites/$data->NOSTAT\'>particularités</a>"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
