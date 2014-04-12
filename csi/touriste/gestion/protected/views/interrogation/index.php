<?php
    $this->pageTitle=Yii::app()->name . ' - Interrogations';
    $this->breadcrumbs = array(
        'Interrogations' => '/interrogation/',
    );
?>

<h1>Requêtes et Interrogations de la base</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'interrogation-form',
    'enableAjaxValidation'=>false,
    'action' => array('interrogation/exec'),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="left">
        <div class="row">
            <?php echo $form->labelEx($model,'sqlreq'); ?>
            <?php echo $form->textArea($model,'sqlreq',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'sqlreq'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Éxécuter'); ?>
        </div>

        <?php echo $form->labelEx($model,'nomreq'); ?>

        <?php echo $form->textField($model,'nomreq'); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo CHtml::submitButton('Sauvegarder', array('name' => 'save')); ?>
        <p class="hint">
            Vous pouvez renseigner un nom pour sauvegarder la requête <br /> et l'éxécuter à nouveau
        </p>
        <?php echo $form->error($model,'nomreq'); ?>
    </div>

    <div class="row right" style="width: 350px;">
        <ul>
            <?php foreach (Interrogation::model()->findAll() as $intero): ?>
                <li>
                    <a href="/interrogation/view/<?php echo $intero->noreq; ?>"><?php echo $intero->nomreq; ?></a>
                    (<a href="/interrogation/supprimer/<?php echo $intero->noreq; ?>">supprimer</a>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="clear"></div>
<br />

<?php
    try {
        if ($data)
            $this->widget('zii.widgets.grid.CGridView', array( 'dataProvider'=>$data,));
        else
            echo 'Aucun résultat';
    } catch (CDbException $e) {
        echo $e->getMessage();
    }
?>
