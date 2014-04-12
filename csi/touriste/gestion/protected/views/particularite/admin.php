<?php
$this->breadcrumbs=array(
    'Particularités'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('particularite-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des particularités</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/particularite/create">Ajouter une particularité</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'particularite-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOPART',
        'NOMPART',
        'ADRESSEPART',
        'DESCRIPTIONPART',
        array(
            'name' => 'HANDI_ACCESSIBLE',
            'value' => '($data->HANDI_ACCESSIBLE) ? "oui" : "non"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
