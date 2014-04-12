<?php
$this->breadcrumbs=array(
    'Disponibilités'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('disponibilite-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des disponibilités</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/disponibilite/create">Ajouter une disponibilité</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'disponibilite-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NODISP',
        'DATEDEBDISP',
        'DATEFINDISP',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
