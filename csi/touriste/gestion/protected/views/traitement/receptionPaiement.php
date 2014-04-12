<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Réception paiement',
);
?>

<h1>Réception d'un paiement</h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div style="font-size: 15px; margin: 40px 0px; text-align: center; color: green;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>

<?php else: ?>

<?php echo $this->renderPartial('//paiement/_form', array('model'=>$model, 'reception'=>true)); ?>

<?php endif; ?>
