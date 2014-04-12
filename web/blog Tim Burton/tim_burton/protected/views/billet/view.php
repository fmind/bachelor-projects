<?php $this->pageTitle='Billet : '.$model->titre ?>

<?php

$this->breadcrumbs=array(
	'Billets' => Yii::app()->createURL('billet/admin'),
    'voir'
);

$this->menu=array(
	array('label'=>'Créer un autre billet', 'url'=>array('create')),
    array('label'=>'Modifier le billet', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Supprimer le billet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gérer les autres billets', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->titre; ?></h1>

<?php $this->widget('application.extensions.tinymce.ETinyMce',array(
                'name'=>'Billet[contenu]',
                'editorTemplate' => 'full',
                'value' => $model->contenu,
                'readOnly' => true
              )
            );
?>

<br />

<h2>Commentaires (<span id="nb_commentaires"><?php echo count($model->commentaires); ?></span>)</h2>

<?php

foreach ($model->commentaires as $commentaire) :
  echo $this->renderPartial('_moderate', array('model'=>$commentaire));
endforeach

?>