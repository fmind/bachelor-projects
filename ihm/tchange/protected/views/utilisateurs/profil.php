<h1>Mon profil</h1>

<? if(Yii::app()->user->hasFlash('profil')): ?>

<div class="flash-success">
    <?= Yii::app()->user->getFlash('profil'); ?>
</div>

<? endif; ?>

<?= $this->renderPartial('_formulaire', array('model'=>$model)); ?>