/**
 * Évènements sur les popup
 */
window.onresize = function (event) {
    popup_centrer();
}
document.onkeydown = function (event) {
    if (event.keyCode == 27) {
        popup_fermer();
    }
}

setFocus = function (elementID) {
    var e = document.getElementById(elementID);
    e.focus();
    var offsetX = getOffsetTop(elementID) - 120;
    window.scrollTo(0, offsetX);
}
getOffsetTop = function(elementID) {
    var e = document.getElementById(elementID);
    var offsetX = 0;
    var parent = e;
    while (parent.constructor.name != "HTMLBodyElement") {
        if (parent.constructor.name != "HTMLFormElement")
            offsetX += parent.offsetTop;
        parent = parent.parentNode;
    }
    return offsetX;
}

setWaterMark = function (e, text) {
    if (e.value == '')
        e.value = text;
}
clearWaterMark = function (e, text) {
    if (e.value == text)
        e.value = '';
}

/**
 * Met à jour la superbar (échanges)
 */
function superbar_update_echanges() {
    $.get('/echanges/superbar', function (data) {
       $('#bar').html(data);
    });
}

/**
 * Afficher un élément en popup
 */
function popup_afficher(element) {
    $('#assombrir').show();
    $(element).show();
    popup_centrer();
}

/**
 * Centre les popups
 */
function popup_centrer() {
    var popups = $('.popup:visible');

    // Redimensionne le fond sombre uniquement si des popups sont affichées
    if (popups.size())
        $('#assombrir').css('height', window.innerHeight + "px");

    // Redimensionne toutes les popups ouvertes
    popups.each(function(i, p) {
        p.style.left = (window.innerWidth - p.offsetWidth) / 2 + "px";
        p.style.top = (window.innerHeight - p.offsetHeight) / 2 + "px";
    });

}

/**
 * Ferme les popups
 */
function popup_fermer() {
   $('#assombrir').hide();
   $('.popup').hide();
}

/**
 * Affiche le formulaire d'inscription
 * @profil identifie le type d'utilisateur
 */
function inscrire(profil) {
    $('#InscriptionForm_profil').attr('value', profil);
    popup_afficher($('#inscription_popup'))
}

/**
 * Change le mode d'affichage du catalogue
 *
 * @mode mode d'affichage
 */
function catalogue_mode(mode) {
    $.cookie('catalogue_mode', mode, {expires: 7, path: '/'});
    location.reload();
}

/**
 * Change le nombre de biens par page dans le catalogue
 * @nb nombre d'item par page
 */
function catalogue_biens_par_page(nb) {
    $.cookie('catalogue_biens_par_page', nb, {expires: 7, path: '/'});
    location.reload();
}

/**
 * Ajoute un bien à la sélection de l'utilisateur
 *
 * @id id du bien
 */
function bien_selectionner(id) {
    $.get('/biens/ajouter/'+id, function (data) {
        if (data)
            alert(data);
        else
            superbar_update_echanges();
    });
}

/**
 * Valide définitivement un échange
 * @echange id de l'échange
 * @bien id de l'objet retenu
 */
function echange_validation(echange, bien)
{
    $.post('/echanges/valider/'+echange, {objet_retenu: bien}, function (data) {
        if (data)
            alert(data);
        else
        {
            $('#echange_choisir').remove();
            superbar_update_echanges();
        }
        popup_fermer();
    });
}

/**
 * Supprime un échange (uniquement le troqueur, échange au statut SELECTION)
 * @id id de l'échange
 */
function echange_supprimer(id)
{
    $.get('/echanges/supprimer/'+id, function(data) {
        if (data)
            alert(data);
        else
            superbar_update_echanges();
    });
}

/**
 * Annuler l'échange
 * @id id de l'échange
 */
function echange_annuler(id) {
    $.get('/echanges/annuler/'+id, function(data) {
        if (data)
            alert(data);
        else
            superbar_update_echanges();
    });
}

/**
 * Propose des biens au troqueur en affichant un popup au troqué
 * @id id de l'échange
 */
function proposition_repondre(id) {
    $.get('/propositions/echange/'+id, function(data) {
         // Retire les précédentes popup
        $('#echange_proposer').remove();
        $('#echange_choisir').remove();

        // Affiche la nouvelle popup
        $('body').append(data);
        popup_afficher('#echange_proposer');
    });
}

/**
 * Ajoute une nouvelle proposition
 * @echange id de l'échange
 * @bien id du bien
 */
function proposition_ajouter(echange, bien) {
    $('#echange_biens_disponibles #bien_disponible_'+bien).hide();
    $('#echange_biens_proposes #bien_propose_'+bien).show();

    $.post('/propositions/ajouter', {echange: echange, bien: bien}, function(data) {
       if (data)
           alert(data);
    });
}

/**
 * Supprime une proposition
 * @echange id de l'échange
 * @bien id du bien
 */
function proposition_supprimer(echange, bien) {
    $('#echange_biens_disponibles #bien_disponible_'+bien).show();
    $('#echange_biens_proposes #bien_propose_'+bien).hide();

    $.post('/propositions/supprimer', {echange: echange, bien: bien}, function(data) {
       if (data)
           alert(data);
    });
}

/**
 * Choisit un bien parmi les propositions du troqué
 * @id id de l'échange
 */
function proposition_choisir(id) {
    $.get('/propositions/choisir/'+id, function(data) {
         // Retire les précédentes popup
        $('#echange_choisir').remove();
        $('#echange_proposer').remove();

        // Affiche la nouvelle popup
        $('body').append(data);
        popup_afficher('#echange_choisir');
    });
}

/**
 * Envoie un message concernant un bien à un utilisateur
 * @destinataire id de l'utilisateur
 * @bien id du bien
 */
function message_question(destinataire, bien) {
    $.get('/messages/question', {destinataire: destinataire, bien: bien}, function(data) {
        // Retire les précédentes popup
        $('#message_question').remove();

        // Affiche la nouvelle popup
        $('body').append(data);
        popup_afficher('#message_question');
    });
}

function afficherAide() {
    var champ = document.getElementById("menuAide");
    switch(champ.value) {
        case "1":
            setFocus('btAjouter');
            document.getElementById("btAjouter").removeAttribute("data-tooltip");
            if (document.getElementById("lblUser"))
                document.getElementById("btAjouter").setAttribute("data-tooltip", "Cliquez sur ce bouton pour ajouter un objet");
            else
                document.getElementById("btAjouter").setAttribute("data-tooltip", "Connectez vous et cliquez sur ce bouton pour ajouter un objet");
            break;
        case "2":
            setFocus('txtRecherche');
            break;
        case "3":
            setFocus('txtRecherche');
            document.getElementById("txtRecherche").removeAttribute("data-tooltip");
            if (window.location.href.indexOf('recherche') >= 0 || window.location.href.indexOf('catalogue') >= 0)
                document.getElementById("txtRecherche").setAttribute("data-tooltip", "Pointez l'élément désiré et cliquez sur demander l'échange OU effectuez une autre recherche");
            else
                document.getElementById("txtRecherche").setAttribute("data-tooltip", "Quel objet cherchez vous à échanger ?");
            break;
        case "4":
            if (document.getElementById("lblUser")) {
                setFocus('hlDeconnexion');
                document.getElementById("hlDeconnexion").removeAttribute("data-tooltip");
                document.getElementById("hlDeconnexion").setAttribute("data-tooltip", "Vous devez d'abord vous déconnecter");
            } else {
                setFocus('hlInscription');
                document.getElementById("hlInscription").removeAttribute("data-tooltip");
                document.getElementById("hlInscription").setAttribute("data-tooltip", "Cliquez ici pour vous inscrire");
            }
            break;
    }
}