<?php
$this->breadcrumbs=array(
    'Particularités'=>array('index'),
    'Créer',
);
?>

<h1>Créer une Particularité</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
