<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Confirmation de réservation',
);
?>

<h1>Confirmer une Demande de Réservation</h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div style="font-size: 15px; margin: 40px 0px; text-align: center; color: green;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>

<?php else: ?>

<?php echo $this->renderPartial('//reservation/_form', array('model'=>$model)); ?>

<?php if ($model->mettre_en_attente): ?>
    <p style="font-weight: bold;">
        Cette demande ne peut pas être satisfaite dans l'immédiat ?<br />
        Vous pouvez mettre cette demande en attente en <a href="/traitement/confirmationReservation?attente=1&ndem=<?php echo $model->NDEM?>&noheberg=<?php echo $model->NOHEBERG ?>">cliquant ici</a>
    </p>
<?php endif; ?>

<?php endif; ?>
