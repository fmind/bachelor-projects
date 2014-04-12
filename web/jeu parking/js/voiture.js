/**************************** CLASSES *****************************/

/**
 * Classe place
 */
function Place(x1, y1, x2, y2, c) {
  this.x1       = x1;
  this.y1       = y1;
  this.x2       = x2;
  this.y2       = y2;
  this.couleur  = c;
  this.prise    = false;
}

Place.prototype.dansX = function(x) { return (x > this.x1 && x < this.x1+this.x2); }
Place.prototype.dansY = function(y) { return (y > this.y1 && y < this.y1+this.y2); }

/**
 * Dessine la place
 */
Place.prototype.dessine = function() {
  ctx.fillStyle = this.couleur;
  ctx.fillRect(this.x1, this.y1, this.x2, this.y2);
}

/**
 * Classe voiture
 */
function Voiture(nom, x, y, vit, couleur) {
  this.nom      = nom;
  this.x        = x;
  this.y        = y;
  this.vit      = vit;
  this.rot      = 0;
  this.couleur  = couleur;
  this.arret    = false;
  this.gare     = false;
  this.surligne = false;
}

Voiture.prototype.dansX = function(x) { return (x > this.x && x < this.x+240); }
Voiture.prototype.dansY = function(y) { return (y > this.y && y < this.y+120); }


/**
 * Dessine une roue
 *
 * @param offset décalage horizontal
 */
Voiture.prototype.dessineRoue = function(offset) {
  ctx.save();

  // Rotation du canvas (permet la rotation de la roue)
  ctx.translate(this.x+offset, this.y+122);                  
  ctx.rotate(Math.PI*2/ar[this.rot%3]);

  // Dessine le cercle
  ctx.beginPath();                        
  ctx.lineWidth=3;
  ctx.arc(0, 0, 22, 0, Math.PI*2, true);
  ctx.stroke();
  ctx.lineWidth=2;

  // Dessine les rayons
  ctx.moveTo(0, 0-22);
  ctx.lineTo(0, 0+22);
  ctx.moveTo(0-22, 0);
  ctx.lineTo(0+22, 0);
  ctx.closePath();
  ctx.stroke();

  ctx.restore();
}

/**
 * Fait avancer la voiture en fonction de la vitesse
 */
Voiture.prototype.dessine = function() {
  // ancien contexte
  prev_strokeStyle = ctx.strokeStyle;
  prev_lineWidth = ctx.lineWidth;

  // Surligne la voiture
  if (this.surligne) {
    ctx.strokeStyle = 'Red';
    ctx.lineWidth=4;
  }

  // Forme de la voiture
  ctx.beginPath();
  ctx.moveTo(this.x+20, this.y+120);
  ctx.quadraticCurveTo(this.x, this.y+70, this.x+100, this.y+60);
  ctx.quadraticCurveTo(this.x+110, this.y+40, this.x+110, this.y+20);
  ctx.quadraticCurveTo(this.x+280, this.y, this.x+260, this.y+120);
  ctx.closePath();
  ctx.stroke();

  // Couleur de remplissage
  ctx.save();
  ctx.fillStyle=this.couleur;             // Couleur de la carosserie
  ctx.fill();                             // Remplit la couleur
  ctx.restore();

  // Dessine les roues
  this.dessineRoue(60);
  this.dessineRoue(220);

  // Affiche le nom
  ctx.save();
  ctx.moveTo(700, this.y+10);
  ctx.font="20px Times New Roman";
  ctx.fillStyle="Red";
  ctx.fillText(this.nom, this.x+110, this.y+90);
  ctx.restore();

  // Adapte la position en fonction de la vitesse
  if (!this.arret && !this.gare) {
    this.x -= this.vit;
    if(this.x<-320) this.x=700;

    // Adapte la position des roues de manière cyclique
    this.rot++;
  }

  // Rétablit les anciens styles
  ctx.strokeStyle = prev_strokeStyle;
  ctx.lineWidth= prev_lineWidth;
}

/**
 * Essaye de garer une voiture
 */
Voiture.prototype.garer = function(place) {
  // Test pour garer la voiture
  // place prise
  if (place.prise) {
    alert("La place est prise !");
    coup_klaxon();
    return false;
  }

  // couleur similaire
  if (this.couleur == place.couleur) {
    alert("Comment la retrouver si elle est de la même couleur :) ?");
    coup_klaxon();
    return false;
  // pas la même file
  } else if ((this.y == 100 && !place.dansY(this.y-60))
            || (this.y == 250 && !place.dansY(this.y+200))) {
    alert("Vous n'êtes pas dans la bonne file");
    coup_klaxon();
    return false;
  // trop loin
  } else if (!place.dansX(this.x)) {
    alert("Vous êtes trop loin pour manoeuvrer !");
    coup_klaxon();
    return false;
  }

  // Nouvelles coordonnées
  this.x = place.x1 - 30;
  this.y = place.y1 - 30;
  this.gare = true;
  this.arret = true;

  // La place est prise
  place.prise = true;

  // Victoire ?
  gagne();
}

/************************** DECLARATIONS **************************/

// Objets partagés
// dessin
var canvas;
var ctx;
// media
var img = new Image();
img.src = 'media/img/fond.jpg';
var pouet;
var f1;

// Couleurs
var c1 = "rgb(160,160,160)";
var c2 = "rgb(0,255,0)";
var c3 = "rgb(0,0,255)";
var c4 = "rgb(255,0,255)";
var c5 = "rgb(0,255,255)";
var c6 = "rgb(0,0,0)";
var couleurs = [
  c1,c2,c3,c4,c5,c6
];

// Voitures
// file gauche
var voiture1 = new Voiture('TUTURE 1', 0, 100, 10, c1);
var voiture2 = new Voiture('TUTURE 2', 350, 100, 10, c2);
var voiture3 = new Voiture('TUTURE 3', 700, 100, 10, c3);
// file droite
var voiture4 = new Voiture('TUTURE 4', 150, 250, 10, c4);
var voiture5 = new Voiture('TUTURE 5', 500, 250, 10, c5);
var voiture6 = new Voiture('TUTURE 6', 850, 250, 10, c6);
var voitures = [
  voiture1,
  voiture2,
  voiture3,
  voiture4,
  voiture5,
  voiture6,
];

// Places
var place1 = new Place(5,10,220,100, c1);
var place2 = new Place(240,10,220,100, c2);
var place3 = new Place(475,10,220,100, c3);
var place4 = new Place(5,410,220,100, c4);
var place5 = new Place(240,410,220,100, c5);
var place6 = new Place(475,410,220,100, c6);
var places = [
  place1,
  place2,
  place3,
  place4,
  place5,
  place6,
];

// Variables d'éxecution (contrôle du cycle)
var nb_klaxons = 0;
var klaxons = [];
var ar=new Array(1, 6, 3);

/*************************** FONCTIONS *****************************/

/**
 * Affiche une belle route
 */
function dessineRoute() {
  // Efface l'écran
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Dessine le fond
  ctx.fillStyle="Green";
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  // Dessine la route
  ctx.beginPath();
  ctx.moveTo(0, 120);
  ctx.lineTo(canvas.width, 120);
  ctx.moveTo(0, 370);
  ctx.lineTo(canvas.width, 400);
  ctx.closePath();
  ctx.stroke();
  ctx.save();

  // Copie bloc par bloc en horizontal
  ctx.translate(0, 120);
  ctx.fillStyle="LightGrey";
  ctx.fillRect(0, 0, canvas.width, 280);
  ctx.drawImage(img, 0, 0);
  ctx.drawImage(img, 280, 0);
  ctx.drawImage(img, 560, 0);
  ctx.restore();
}

/**
 * Donne un méchant coup de klaxon
 */
function coup_klaxon() {
  nb_klaxons++;
  pouet.play();
}

/**
 * Vérifie si vous avez gagné (toutes les voitures garées)
 */
function gagne() {
  var g = true;
  $.each(voitures, function(i,v) {
    if (!v.gare) g = false;
  });

  if (g) {
    cycle();
    f1.play();
    alert("Bravo ! Toutes les voitures sont garées en " + nb_klaxons + " coups de klaxons");
  }
}

/************************** EXECUTION **************************/

// Boucle d'exécution
var cycle=function() {
  // Dessine la route
  dessineRoute();

  // Dessine les places
  $(places).each(function(i,p) {
    p.dessine();
  });

  // Dessine les voitures
  $(voitures).each(function(i,v) {
    v.dessine();
  });
};

// On ready
$(document).ready(function() {
  // Initialise les objets
  canvas = document.getElementById('parking');
  ctx = canvas.getContext('2d');
  pouet = document.getElementById('pouet');
  f1 = document.getElementById('f1');

  // Drag
  $(canvas).mousedown(function(e) {
    // Récupère les coordonnées cliquées
    var x = e.pageX-$(this).offset().left;
    var y = e.pageY-$(this).offset().top;

    $(voitures).each(function(i,v) {
      // Elle ne doit pas être garée
      if (!v.gare) {
        // Arrête les voitures de la file cliquée
        if (v.dansY(y)) {
          this.arret = true;

          // Surligne la voiture cliquée
          if (v.dansX(x)) {
            v.surligne = true;
          } else {
            klaxons.push(setInterval(coup_klaxon, (i+1)*1000));
          }
        // Redémarre les voitures de l'autre file
        } else {
          v.arret = false;
          v.surligne = false;
        }
      }
    });
  });

  // Drop
  $(canvas).mouseup(function(e) {
    // Récupère les coordonnées cliquées
    var x = e.pageX-$(this).offset().left;
    var y = e.pageY-$(this).offset().top;

    // Arrête les klaxons
    $(klaxons).each(function(i,k) {
      clearInterval(k);
    });
    klaxons = [];

    // Récupère la voiture surlignée
    var voiture;
    $(voitures).each(function(i,v) {
      if (v.surligne) voiture = v;
      v.surligne = false;
      v.arret = false;
    });

    // Récupère la place cliquée
    var place;
    $(places).each(function(i,p) {
      if (p.dansX(x) && p.dansY(y)) {
        place = p;
      }
    });

    // Essaye de garer la voiture
    if (voiture && place) voiture.garer(place);
  });

  setInterval(cycle, 50);
});