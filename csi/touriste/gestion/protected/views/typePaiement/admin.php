<?php
$this->breadcrumbs=array(
    'Type de paiement'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('type-paiement-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion de types de paiement</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/typePaiement/create">Ajouter un type de paiement</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'type-paiement-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOTYPPAIE',
        'LIBELLETYPPAIE',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
