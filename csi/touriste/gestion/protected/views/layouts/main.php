<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="fr" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header" class="align_center">
        <a href="/" style="text-decoration: none; color: black;">
            <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
        </a>
    </div><!-- header -->

    <? if (!Yii::app()->user->isGuest): ?>
    <div id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Accueil', 'url'=>'/'),
                array('label'=>'Gestions', 'url'=>array('/gestion/')),
                array('label'=>'Interrogations', 'url'=>array('/interrogation/')),
                array('label'=>'Traitements', 'url'=>array('/traitement/')),
                array('label'=>'Déconnexion ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),
            ),
        )); ?>
    </div><!-- mainmenu -->
    <? else: ?>
        <hr />
    <? endif; ?>

    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?><br/>
        Tous droits réservés.<br/>
        Médéric - Anne-Sophie - Jérémy - Apote
    </div><!-- footer -->

</div><!-- page -->

</body>
</html>
