<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Analyse des Échéances',
);
?>

<h1>Analyse des Échéances</h1>
<br /><br />

<h3>Réservations Impayées</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'impaye-grid',
    'dataProvider'=> $data_provider_res,
    'columns'=>array(
        array(
            'name' => 'Réservation',
            'value' => '$data["NORES"]',
        ),
        array(
            'name' => 'Hébergement',
            'value' => '$data["NOHEBERG"]',
        ),
        array(
            'name' => 'Client',
            'value' => '$data["NOM"]." ".$data["PRENOM"]." <".$data["EMAILCLIENT"].">"',
        ),
        array(
            'name' => 'État',
            'value' => '$data["ETATRES"]',
        ),
        array(
            'name' => 'Début du séjour',
            'value' => '$data["DATEDEBUTRES"]',
        ),
        array(
            'name' => 'Montant total',
            'value' => '$data["MONTANTRES"]',
        ),
        array(
            'name' => 'Montant restant',
            'value' => '$data["MONTANTRES"] - Yii::app()->db->createCommand("SELECT SUM(MONTANTPAIE) as total FROM Paiement WHERE NORES = ".$data["NORES"])->queryScalar();',
        ),
        array(
            'name' => 'Action à effectuer',
            'value' => '(new Datetime($data["DATEDEBUTRES"]) >= new Datetime(date("Y-m-d"))) ? "rappeler le client" : "transmettre le dossier"',
        ),
        array(
            'type' => 'html',
            'value' => '"<a href=\'/traitement/analyseEcheances/".$data["NORES"]."?ref=1\'>refuser</a>"',
        ),
    ),
)); ?>

<br /><br />

<h3>Chiffre d'affaire par Saison</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'impaye-grid',
    'dataProvider'=> $data_provider_sais,
    'columns'=>array(
        'NOSAISON',
        'DATEDEBS',
        'DATEFINS',
        array(
            'name' => 'État',
            'value' => '(new Datetime($data->DATEFINS) < new Datetime()) ? "Saison terminé" : "Saison en cours"',
        ),
        array(
            'name' => 'Bénéfice',
            'value' => 'Yii::app()->db->createCommand("SELECT SUM(MONTANTPAIE) as total FROM Paiement WHERE DATEPAIE BETWEEN \'".$data->DATEDEBS."\' AND \'".$data->DATEFINS."\'")->queryScalar();',
        ),
    ),
)); ?>
