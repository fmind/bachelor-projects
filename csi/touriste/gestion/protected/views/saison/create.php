<?php
$this->breadcrumbs=array(
    'Saisons'=>array('index'),
    'Créer',
);
?>

<h1>Créer une Saison</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
