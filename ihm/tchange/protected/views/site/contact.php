<div id="contact">
    <?php
    $this->pageTitle = "Contactez nous";
    ?>

    <h1>Contactez nous</h1>


    <?php if (Yii::app()->user->hasFlash('contact')): ?>

        <div class="successMessage align_center">
            <?php echo Yii::app()->user->getFlash('contact'); ?>
        </div>

    <?php else: ?>

        <p class="classic_font align_center">
            Pour une question ou une remarque, merci de nous contacter !
        </p>

        <br />

        <div class="form classic_font">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'contact-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                    ));
            ?>

            <div class="nom">
                <?php echo $form->labelEx($model, 'name'); ?>
                <?php echo $form->textField($model, 'name'); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>

            <div class="mail">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email'); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>

            <div class="contact-text">
                <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'body'); ?>
            </div>

            <?php if (CCaptcha::checkRequirements()): ?>
                <div class="row">

                    <div class="captcha">
                        <span id="tips-captcha" class="tipr2" style="position: absolute;"><h6 data-tooltip="Rafraichir le logo"></h6></span>
                        <?php $this->widget('CCaptcha'); ?><br/>
                        <?php echo $form->textField($model, 'verifyCode'); ?>
                    </div>

                    <?php echo $form->error($model, 'verifyCode'); ?>
                </div>
            <?php endif; ?>

            <div class="clear"></div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Envoyer'); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->

    <?php endif; ?>

</div>