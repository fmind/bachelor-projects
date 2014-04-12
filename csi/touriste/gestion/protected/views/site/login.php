<?php
$this->pageTitle=Yii::app()->name . ' - Connexion';
?>

<h1 class="align_center">Connexion à la Base Touriste</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
)); ?>

    <div class="row align_center">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row align_center">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row buttons align_center">
        <?php echo CHtml::submitButton('Se Connecter'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
