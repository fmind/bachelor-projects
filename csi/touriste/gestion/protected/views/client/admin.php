<?php
$this->breadcrumbs=array(
    'Clients'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('client-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des clients</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/client/create">Ajouter un client</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'client-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOCLIENT',
        'NOM',
        'PRENOM',
        'DATENAISS',
        'SEXE',
        'SITMARITAL',
        /*
        'TELEPHONECLIENT',
        'EMAILCLIENT',
        'ADRESSECLIENT',
        */
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
