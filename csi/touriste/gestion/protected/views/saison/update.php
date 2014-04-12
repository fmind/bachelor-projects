<?php
$this->breadcrumbs=array(
    'Saisons'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier la Saison <?php echo $model->NOSAISON; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
