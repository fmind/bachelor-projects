<div class="form">

<? if(Yii::app()->user->hasFlash('bien')): ?>

<div class="flash-success">
    <?= Yii::app()->user->getFlash('bien'); ?>
</div>

<? endif; ?>

<? $form=$this->beginWidget('CActiveForm', array(
	'id'=>'biens-proposer-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data',)
)); ?>

	<p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'nom'); ?>
		<?= $form->textField($model,'nom'); ?>
		<?= $form->error($model,'nom'); ?>
	</div>

    <?
        $categories = new Categories();
        $sous_categories = new SousCategories();

        if ($model->sous_categorie)
        {
            $categories_select = CHtml::listData($categories->findAll(), 'id', 'nom');
            $categorie_selectionnee = Categories::model()->find('id=:categorie', array('categorie' => $model->sousCategorieRel->categorie))->id;
            $sous_categories_select = CHtml::listData($sous_categories->findAll('categorie=:categorie', array('categorie' => $categorie_selectionnee)), 'id', 'nom');
        }
        else
        {
            $categories_select = CHtml::listData($categories->findAll(), 'id', 'nom');
            $categorie_selectionnee = array_shift(array_keys($categories_select));
            $sous_categories_select = CHtml::listData($sous_categories->findAll('categorie=:categorie', array('categorie' => $categorie_selectionnee)), 'id', 'nom');
        }

    ?>

    <div class="row">
		<?= CHtml::label('Catégorie', 'categorie'); ?>
		<?= CHtml::dropDownList('categorie', $categorie_selectionnee, $categories_select); ?>
	</div>

    <div class="row">
		<?= $form->label($model,'sous_categorie'); ?>
		<?= $form->dropDownList($model, 'sous_categorie', $sous_categories_select); ?>
		<?= $form->error($model,'sous_categorie'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'description'); ?>
		<?= $form->textArea($model,'description'); ?>
		<?= $form->error($model,'description'); ?>
	</div>

    <div class="row">
		<?= $form->labelEx($model,'tags'); ?>
		<?= $form->textField($model,'tags'); ?>
		<?= $form->error($model,'tags'); ?>
	</div>

	<div class="row" style="text-align: center">
		<?= $form->labelEx($model,'photo'); ?>
		<?= $form->fileField($model,'photo'); ?>
		<?= $form->error($model,'photo'); ?>

        <? if ($model->photo): ?>
        <img src="<?= Biens::getPhotoSrc($model); ?>" alt="Photo de <?= $model->nom ?>" style="margin: 0 0 0 16px" />
        <? endif; ?>
	</div>

	<div class="row-buttons">
		<?= CHtml::submitButton("Enregistrer"); ?>
	</div>

<? $this->endWidget(); ?>

</div><!-- form -->

<script>
var categorie = $('#categorie');
var sous_categorie = $('#Biens_sous_categorie');

categorie.change(function(e) {
    $.getJSON('/sousCategories/parCategorie', {categorie: $(this).find('option:selected').attr('value')}, function(data) {
        sous_categorie.children().remove();
        $(data).each(function(i, cat) {
            var option = $('<option />').attr('value', cat.id).text(cat.nom)
            sous_categorie.append(option)
        });
    });
});
</script>