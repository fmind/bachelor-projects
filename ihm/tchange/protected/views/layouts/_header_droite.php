<div id="droite" class="post-it">
    <? if (Yii::app()->user->isGuest): ?>
    <span class="tipl1" style="position:relative">
        <h6 data-tooltip="Saisissez votre adresse email et mot de passe pour vous connecter">Identification</h6>
    </span>

        <?
            $model = new LoginForm();
            $form = $this->beginWidget('CActiveForm', array(
                            'id'=>'login-form',
                            'action' => '/site/login',
                            'enableAjaxValidation' => true,
                            'clientOptions' => array(
                                    'validateOnSubmit' => true,
                            ),
                        ));
        ?>

        <div class="ligne">
            <?= $form->label($model,'login'); ?>
            <?= $form->textField($model,'login', array('class' => 'border-radius-3 bg-blanc border-gris-clair gris email')); ?>
            <?= $form->error($model,'login'); ?>
        </div>

        <div class="ligne">
            <?= $form->label($model,'password'); ?>
            <?= $form->passwordField($model,'password', array('class' => 'border-radius-3 bg-blanc border-gris-clair gris password')); ?>
            <?= $form->error($model,'password'); ?>
        </div>

        <?= CHtml::submitButton('Connexion', array('class' => 'border-gris-clair border-radius-3')); ?>

    <? $this->endWidget(); ?>

    <? else: ?>

    <h6 id="lblUser" class="bonjour">Bonjour <?= substr_replace(strtolower(Yii::app()->user->id),strtoupper(substr(Yii::app()->user->id,0,1)),0,1); ?><span class="profil">(<?= CHtml::link("Modifier", "/utilisateurs/profil"); ?>)</span></h6>
    <span class="espace"><a>Accéder à mon espace</a></span>
    <span class="biens"><?= CHtml::link("Voir mes biens", "/biens/"); ?></span>
    <span class="deco tipb"><?= CHtml::link("Déconnexion", "/site/logout", array('id' => 'hlDeconnexion')); ?></span>

    <? endif;?>
</div>