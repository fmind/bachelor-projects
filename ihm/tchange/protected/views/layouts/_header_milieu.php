<div id="milieu">
    <a href="/"><img src="/images/logo.png" /></a>

    <? $form = $this->beginWidget('CActiveForm', array('method' => 'get', 'action' => '/biens/recherche')); ?>
        <span class="tipb" style="position:relative;"><?= CHtml::textField('q', ($_GET['q']) ? $_GET['q'] : '', array('id' => "txtRecherche",  'class' => "recherche border-radius-5 border-gris-clair bg-blanc", "data-tooltip" => "Saisissez ici les termes de votre recherche")); ?></span>
    <span id="loupe" onclick="document.getElementById('yw0').submit();">
    </span>
    <? $this->endWidget(); ?>
</div>