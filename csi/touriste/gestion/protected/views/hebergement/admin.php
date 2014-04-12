<?php
$this->breadcrumbs=array(
    'Hébergements'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('hebergement-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des hébergements</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/hebergement/create">Ajouter un hébergement</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'hebergement-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOHEBERG',
        array(
            'name' => 'NOPREST',
            'value' => '$data->prestataireRel->NOMPREST',
        ),
        array(
            'name' => 'NOTYPH',
            'value' => '$data->typeHebergRel->NOMTYPH',
        ),
        'QUALITE',
        'SURFACE',
        'NBLITADULT',
        'NBLITENFANT',
        array(
            'type' => 'html',
            'value' => '"<a href=\'/hebergement/disponibilites/$data->NOHEBERG\'>disponibilités</a>"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
