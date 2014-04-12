<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Demandes en attente',
);
?>

<h1>Demandes en attente</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'demande-grid',
    'dataProvider'=> $data_provider,
    'columns'=>array(
        'NDEM',
        array(
            'name' => 'NOCLIENT',
            'value' => '$data->clientRel->NOM',
        ),
        array(
            'name' => 'NOTYPH',
            'value' => '$data->typeHebergRel->NOMTYPH',
        ),
        array(
            'name' => 'NOTYPEPREST',
            'value' => '$data->typePrestRel->NOMTYP',
        ),
        array(
            'name' => 'NOSTAT',
            'value' => '$data->stationRel->NOMSTAT',
        ),
        'DATEDEBUTRES',
        'DATEFINRES',
        'NBPERSRES',
        array(
            'type' => 'html',
            'value' => '"<a href=\'/traitement/demandeAttente/$data->NDEM?prop=1\'>proposer</a>"',
        ),
        array(
            'type' => 'html',
            'value' => '"<a href=\'/traitement/demandeAttente/$data->NDEM?ref=1\'>refuser</a>"',
        ),
    ),
)); ?>
