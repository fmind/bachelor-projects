<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Versement arrhes',
);
?>

<h1>Versement d'arrhes</h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div style="font-size: 15px; margin: 40px 0px; text-align: center; color: green;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>

<?php else: ?>

<?php echo $this->renderPartial('//paiement/_form', array('model'=>$model)); ?>

<?php endif; ?>
