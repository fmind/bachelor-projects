<?php
$this->breadcrumbs=array(
    'Paiements'=>array('index'),
    'Gestion',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('paiement-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gestion des paiements</h1>

<p>
    Vous pouvez utiliser les opérateurs de comparison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) dans les cases de filtre pour affiner votre recherche.
</p>

<a href="/paiement/create">Ajouter un paiement</a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'paiement-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'NOPAIE',
        array(
            'name' => 'NORES',
            'value' => '$data->reservationRel->NORES',
        ),
        array(
            'name' => 'NOTYPPAIE',
            'value' => '$data->typePaiementRel->LIBELLETYPPAIE',
        ),
        'LIBELLEPAIE',
        'MONTANTPAIE',
        'DATEPAIE',
        array(
            'name' => 'REMBOURSEPAIE',
            'value' => '($data->REMBOURSEPAIE) ? "oui" : "non"',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
