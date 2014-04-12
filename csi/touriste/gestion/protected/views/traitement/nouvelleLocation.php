<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Nouvelle Location',
);
?>

<h1>Nouvelle Location</h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div style="font-size: 15px; margin: 40px 0px; text-align: center; color: green;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>

<?php else: ?>

<?php echo $this->renderPartial('//hebergement/_form', array('model'=>$model)); ?>

<?php endif; ?>
