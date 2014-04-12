<? if (!Yii::app()->user->isGuest): ?>
<div id="message_question" class="popup">
    <div class="titre">
        <a href="javascript:popup_fermer();" class="fermer">X</a>
        <h3>Poser une question</h3>
    </div>


    <?= $this->renderPartial('//messages/_formulaire', array('model'=>$model)); ?>
</div>

<script>
    $('#message-form').ajaxForm({
        success: function(responseText, statusText, xhr, $form) {
            if (responseText)
                alert(responseText);
            else {
                alert('Votre message a été envoyé avec succès');
                popup_fermer();
            }
        }
    });
</script>

<? else: ?>
<div id="message_question" class="popup">
    <div class="titre">
        <a href="javascript:popup_fermer();" class="fermer">X</a>
        <h3>Poser une question</h3>
    </div>


    Vous devez vous connecter pour poser une question
</div>
<? endif; ?>