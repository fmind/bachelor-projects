<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?= $this->renderPartial('//layouts/_include'); ?>
</head>
<body id="bg-normal">
    <div id="assombrir"></div>

    <div id="opaque">
        <div id="content">
            <?= $this->renderPartial('//layouts/_header'); ?>

            <?= $content; ?>

            <?= $this->renderPartial('//layouts/_footer'); ?>
        </div>

        <? if (Yii::app()->user->isGuest): ?>
        <?= $this->renderPartial('//utilisateurs/inscription'); ?>
        <? endif; ?>

        <? if (!Yii::app()->user->isGuest): ?>
        <?= $this->renderPartial('//layouts/_superbar'); ?>
        <? endif; ?>
    </div>
</body>
</html>