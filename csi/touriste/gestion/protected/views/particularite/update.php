<?php
$this->breadcrumbs=array(
    'Particularités'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier la Particularité <?php echo $model->NOPART; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
