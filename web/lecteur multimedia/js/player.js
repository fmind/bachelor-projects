/**
 * Fonctions liées au player javascript
 *
 * @author Médéric Hurier
 */

/*
 * Variables globales
 */
var p;              // Player
var timer;          // Slide d'avancement de la vidéo
var refresh;        // Fonction refresh sur vidéo

/**
 * Affiche la popup "A propos"
 */
function popup_a_propos() {
  $('#a_propos').dialog({title: 'A propos'});

}

/**
 * Affiche la popup "Ouvrir un nouveau fichier"
 */
function popup_ouvrir_media() {
  $('#ouvrir_media').dialog({title: 'Ouvrir un fichier', width: 'auto'});
}

/**
 * Évènement des boutons
 */
function _bouton_events() {
  $('.boutons .lecture').click(function() {
    if (p.error) return;
    if ($(this).text() == 'Lecture') {
      p.play();
      $(this).text('Pause');
    } else {
      p.pause();
      $(this).text('Lecture');
    }
  });
  $('.boutons .stop').click(function() {
    if (p.error) return;
    if ($('.boutons .lecture').text() == 'Pause') {
      $('.boutons .lecture').trigger('click');
    }
    p.currentTime = 0.0;
  });
  $('.boutons .avancer').click(function() {
    if (p.error) return;
    p.currentTime += p.duration * 0.1;
  });
  $('.boutons .reculer').click(function() {
    if (p.error) return;
    p.currentTime -= p.duration * 0.1;
  });
  $('.boutons .plein_ecran').click(function() {
    if (p.error) return;
    if ($(this).text() == 'Plein écran') {
      $(p).attr('width', '100%');
      $(this).text('Taille vidéo');
    } else {
      $(p).attr('width', p.videoWidth);
      $(this).text('Plein écran');
    }
  });
  $('.boutons .vol_minus').click(function() {
    if (p.error) return;
    if (p.volume > 0.0) p.volume -= 0.1;
  });
  $('.boutons .vol_plus').click(function() {
    if (p.error) return;
    if (p.volume < 1.0) p.volume += 0.1;
  });
  $('.boutons .vol_muet').click(function() {
    if (p.error) return;
    if ($(this).text() == 'Muet') {
      p.muted = true;
      $(this).text('Audible');
    } else {
      p.muted = false;
      $(this).text('Muet');
    }
  });
}

/**
 * En cas d'erreur
 */
function on_error() {
  switch (p.error.code) {
    case p.error.MEDIA_ERR_ABORTED:
      alert("Vous avez stopé la vidéo");
      break;
    case p.error.MEDIA_ERR_NETWORK:
      alert("Erreur Réseau. Réesayer");
      break;
    case p.error.MEDIA_ERR_DECODE:
      alert("Impossible de décoder la vidéo");
      break;
    case p.error.MEDIA_ERR_SRC_NOT_SUPPORTED:
      alert("Votre navigateur ne supporte pas ce type de format");
      break;
  }
  $('.player h1').text('Choisissez un autre media');
}

/**
 * Au changement de média
 */
function on_changement() {
  $('.boutons .stop').trigger('click'); // Stop la vidéo

  $(p).replaceWith(
    // Touilette
    $('<video />').attr('src', $(this).val().replace('C:\\fakepath\\', 'media/'))
  );

  chargement_media();
}

/**
 * Au chargement des metadata
 */
function on_metadata() {
  if (p.error) return;

  timer.attr('max', Math.round(p.duration));
  $('.player h1').text($(p).attr('src'));
}

/**
 * Quand le lecteur est prêt
 */
function on_ready() {
  // Rafraichissement de l'avancement
  clearInterval(refresh);
  refresh = setInterval(function() {
    timer.val(p.currentTime);
  }, 500);
}

function chargement_media () {
  p = $('.player video').get(0);
  $(p).bind('loadedmetadata', on_metadata);
  $(p).bind('error', on_error);
  $(p).bind('canplay', on_ready);

  // Au clic sur un élément vidéo
  $('video').click(function() {
    $('.boutons .lecture').trigger('click');
  });
}

$(document).ready(function() {
  timer = $('#timer');

  // Charge le média initial
  chargement_media();

  // Évènements des boutons
  _bouton_events();

  // Au changement du timer
  timer.change(function (e) {
    if (p.error) {
      $(this).val(0);
      return;
    }
    p.currentTime = $(this).val();
  });

  // Changement de média
  $('#nouveau_media').change(on_changement);
});