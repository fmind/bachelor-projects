<?php
$this->breadcrumbs=array(
    'Types de Paiement'=>array('index'),
    'Créer',
);
?>

<h1>Créer un Type de Paiement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
