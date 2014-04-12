<?php
$this->breadcrumbs=array(
    'Paiements'=>array('index'),
    'Créer',
);
?>

<h1>Créer un Paiement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
