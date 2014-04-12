package arbrebp

import arbrebp.Noeud;

/**
 * Représente le noeud d'un arbre B+
 *
 * @author Médéric Hurier - Maxime Bruant
 */
class Noeud {
  int ordre                         // Ordre de l'arbre (Ex: n=3)
  int type                          // Type (interne, feuille)
  Noeud parent                      // Noeud parent
  ArrayList<Object> valeurs = []    // Clées stockées
  Map<Object, Object> donnees = [:] // Données associées
  ArrayList<Noeud> fils = []        // Noeuds fils

  // Types de noeuds
  static int INTERNE  = 1
  static int FEUILLE  = 2
  static Map TYPES = [
    1: 'I'
    ,2: 'F'
  ]

  /**
   * Constructeur
   *
   * @author Médéric Hurier
   */
  Noeud(int ordre, int type, Noeud parent=null) {
    this.ordre= ordre
    this.type = type
    this.parent = parent
  }

  /**
   * Recherche sur valeur
   *
   * @author Maxime Bruant
   * @returns La valeur ou null
   */
  def recherche(valeur) {
    if (this.type == Noeud.INTERNE) {
      return this.fils.get(this.indexDe(valeur)).recherche(valeur)
    } else {
      return this.donnees[valeur]
    }
  }

  /**
   * Ajout d'une valeur
   *
   * @note ne gère pas les doublons
   * @author Médéric Hurier
   */
  def ajout(valeur, donnee) {
    // Pas de doublons
    if (valeur in this.valeurs) return

    if (this.type == Noeud.FEUILLE) {
      // Ajoute le noeud au tableau de valeurs
      this.valeurs.add(valeur)
      this.donnees[valeur] = donnee

      // Équilibrage de l'arbre
      this.trier()
      this.equilibrerApresAjout()
    } else {
      // Descente jusqu'au noeud feuille
      def i = this.indexDe(valeur)
      this.fils[i].ajout(valeur, donnee)
    }
  }

  /**
   * Recherche du noeud feuille poss�dant la valeur pass�e en param�tre
   *
   * @author Maxime Bruant
   */
  def rechercheN(valeur) throws ArbreException {
    if (this.type == Noeud.INTERNE) {
      this.fils.get(this.indexDe(valeur)).rechercheN(valeur)
    } else {
      return this
    }
  }

  /**
   * Suppression d'une valeur
   *
   * @author Maxime Bruant
   */
  def suppression(valeur) throws ArbreException {
    Noeud n = rechercheN(valeur)
    Noeud n2 = n
    def i = n.valeurs.indexOf(valeur)
    n.valeurs.remove(i)
    while(n2.parent){
      n2.valeurs.sort{it}
      if(valeur in n2.parent.valeurs){
        i = n2.parent.valeurs.indexOf(valeur)
        n2.parent.valeurs.remove(i)
        if(n2.parent.parent){
          n2.parent.valeurs.add(i, n2.valeurs.get(0))
        }else{
          n2.parent.valeurs.add(i, n.valeurs.get(0))
        }
      }
      n2 = n2.parent
    }
    equilibrerApresSuppression(n)
  }

  /**
   * Affichage du tableau dans la console
   *
   * @author Médéric Hurier
   */
  def afficher(int indent=4, int niveau=0) {
    // Affichage du noeud courant
    print " "*(indent*niveau)
    print "${this.valeurs} : "
    print "${this.donnees} "
    println Noeud.TYPES[this.type]

    niveau++ // Niveau d'indentation supplémentaire

    // Affichage des fils
    this.fils.each {
      print " "*indent*niveau
      it.afficher(indent, niveau)
    }
  }

  /**
   * Détermine l'index précédant la première valeur supérieur ou égale à la valeur recherchée
   *
   * @author Maxime Bruant
   */
  private def indexDe(valeur) {
    int i = 0
    for (v in this.valeurs) {
      if (v > valeur) break
      i++
    }
    return i
  }

  /**
   * Équilibre le noeud en l'éclatant et en le fusionnant avec son parent
   *
   * @author Médéric Hurier
   */
  private def equilibrerApresAjout() {
    if (this.valeurs.size() > this.ordre) {
      this.eclatement()

      // Assimile un fils
      if (this.parent) parent.fusionne(this)
    }
  }

  /**
   * Équilibre le noeud après suppression d'un élément
   *
   * @author Maxime Bruant
   */
  private def equilibrerApresSuppression(Noeud n) {
    if(n.parent){
      if(n.valeurs.size < ordre/2){
        if(n.parent.fils.indexOf(n) == 0){
          casnoeuddroite(n)
        }else{
          if(n.parent.fils.indexOf(n) == n.parent.fils.size-1){
            casnoeudgauche(n)
          }else{
            choixducas(n)
          }
        }
      }
      equilibrerApresSuppression(n.parent)
    }
  }
	
  /**
   * Equilibre le noeud n avec son voisin de droite
   *
   * @author Maxime Bruant
   */
  private def casnoeuddroite(Noeud n){
    println "cas utilisation noeud de droite"
    Noeud p = n.parent
    Noeud n2 = p
    def ind = p.fils.indexOf(n);
    Noeud noeuddroite = p.fils.get(ind+1)
    def val = noeuddroite.valeurs.get(0)
    def don = null;
    if(n.type == FEUILLE){
      don = noeuddroite.donnees.get(0)
    }else{
      don = noeuddroite
    }
    def i = p.valeurs.indexOf(val)
    if(noeuddroite.valeurs.size-1 >= ordre/2){
      //Redistribution des cl�s
      if(n.type == FEUILLE){
        n.ajout(val, don)
      }else{
        n.valeurs.add(val)
      }
      p.valeurs.remove(i)
      noeuddroite.valeurs.remove(0)
      if(n.type == FEUILLE) noeuddroite.donnees.remove(0)
      p.valeurs.add(i,noeuddroite.valeurs.get(0))
      while(n2.parent){
        if(val in n2.parent.valeurs){
          i = n2.parent.valeurs.indexOf(val)
          n2.parent.valeurs.remove(i)
          if(n2.parent.parent){
            n2.parent.valeurs.add(i, n2.valeurs.get(0))
          }else{
            n2.parent.valeurs.add(i, n.valeurs.get(0))
          }
        }
        n2 = n2.parent
      }
    }else{
      //Fusion
      def j = 0
      if(n.type == INTERNE) {
        noeuddroite.valeurs.add(0,noeuddroite.fils.get(0).valeurs.get(0))
      }
      for(v in n.valeurs){
        if(n.type == FEUILLE){
          noeuddroite.ajout(v, n.donnees.get(n.valeurs.indexOf(v)))
        }else{
          noeuddroite.valeurs.add(v)
          noeuddroite.fils.add(n.fils.get(j))
          j++
        }
      }
      if(n.type == INTERNE) {
        noeuddroite.fils.add(n.fils.get(j))
        noeuddroite.fils.sort{it.valeurs.get(0)}
        noeuddroite.valeurs.sort{it}
      }
			
      p.fils.remove(p.fils.indexOf(n))
      if(n.parent.parent){
        p.valeurs.remove(i)
      }else{
        if(val in p.valeurs) p.valeurs.remove(i)
        if(n.type == INTERNE) changerracine(noeuddroite)
      }
    }
  }
	
  /**
   * Equilibre le noeud n avec son voisin de gauche
   *
   * @author Maxime Bruant
   */
  private def casnoeudgauche(Noeud n){
    println "cas utilisation du noeud de gauche"
    Noeud p = n.parent
    Noeud n2 = p
    def ind = p.fils.indexOf(n)
    Noeud noeudgauche = p.fils.get(ind-1)
    def last = noeudgauche.valeurs.size-1
    def val = noeudgauche.valeurs.get(last)
    def don = null
    if(n.type == FEUILLE) don = noeudgauche.donnees.get(last)
    //Redistribution des cl�s
    if(noeudgauche.valeurs.size-1 >= ordre/2){
      if(n.type == FEUILLE) n.ajout(val, don)
      noeudgauche.valeurs.remove(last)
      if(n.type == FEUILLE) noeudgauche.donnees.remove(last)
      p.valeurs.remove(ind-1)
      p.valeurs.add(ind-1,p.fils.get(ind).valeurs.get(0))
      while(n2.parent){
        if(val in n2.parent.valeurs){
          i = n2.parent.valeurs.indexOf(val)
          n2.parent.valeurs.remove(i)
          if(n2.parent.parent){
            n2.parent.valeurs.add(i, n2.valeurs.get(0))
          }else{
            n2.parent.valeurs.add(i, n.valeurs.get(0))
          }
        }
        n2 = n2.parent
      }
    }else{
      //Fusion
      def j = 0
      if(n.type == INTERNE) {
        noeudgauche.valeurs.add(0,noeudgauche.fils.get(0).valeurs.get(0))
      }
      for(v in n.valeurs){
        if(n.type == FEUILLE){
          noeudgauche.ajout(v, n.donnees.get(n.valeurs.indexOf(v)))
        }else{
          noeudgauche.valeurs.add(v)
          noeudgauche.fils.add(n.fils.get(j))
          j++
        }
      }
      if(n.type == INTERNE) {
        noeudgauche.fils.add(0,n.fils.get(j))
        noeudgauche.fils.sort{it.valeurs.get(0)}
      }
      p.fils.remove(ind)
      if(n.parent.parent){
        p.valeurs.remove(ind-1)
      }else{
        if(val in p.valeurs) p.valeurs.remove(ind-1)
        if(n.type == INTERNE) changerracine(noeudgauche)
      }
    }
  }
	
  /**
   * Choix du cas � prendre
   *
   * @author Maxime Bruant
   */
  private def choixducas(Noeud n){
    Noeud p = n.parent
    def ind = p.fils.indexOf(n);
    if(p.fils.get(ind+1) && p.fils.get(ind-1)){
      if(p.fils.get(ind+1).valeurs.size>p.fils.get(ind-1).valeurs.size){
        casnoeuddroite(n);
      }else{
        casnoeudgauche(n);
      }
    }else{
      if(p.fils.get(ind+1)){
        casnoeuddroite(n);
      }else{
        if(p.fils.get(ind-1)) casnoeudgauche(n);
      }
    }
  }
	
  /**
   * Changement de la racine
   *
   * @author Maxime Bruant
   */
  private def changerracine(Noeud n){
    Noeud p = n.parent
    p.valeurs.removeAll(p.valeurs)
    p.fils.removeAll(p.fils)
    p.valeurs.addAll(n.valeurs)
    p.fils.addAll(n.fils)
    for(f in p.fils){
      f.parent = p
    }
    p.parent = null
  }
	
  /**
   * Tri sur les valeurs et fils
   *
   * @author Médéric Hurier
   */
  private def trier() {
    this.valeurs.sort { it }
    this.fils.sort { it.valeurs[0] }
  }

  /**
   * Éclate un noeud dont la taille est supérieur à l'ordre en 2 noeuds fils
   *
   * @author Médéric Hurier
   */
  private def eclatement() {
    // Index séparateur
    // Ex: n = 3, i = 1 / n = 4, i = 1 / n = 5, i = 2 / n = 6, i = 2
    int i = Math.ceil(this.ordre/2) - 1 // -1 Pour tenir compte de l'index de départ des tableaux

    // Créer deux noeuds fils
    Noeud noeud_gauche = new Noeud(this.ordre, this.type, this)
    Noeud noeud_droit = new Noeud(this.ordre, this.type, this)

    // Valeurs
    noeud_gauche.valeurs = this.valeurs[0..i] as ArrayList
    noeud_droit.valeurs = (this.valeurs - noeud_gauche.valeurs) as ArrayList
    this.valeurs = [this.valeurs[i+1]]

    // Donnees (seulement pour noeuds feuilles)
    if (this.type == Noeud.FEUILLE) {
      for (valeur in noeud_gauche.valeurs) {
        noeud_gauche.donnees[valeur] = this.donnees[valeur]
      }
      for (valeur in noeud_droit.valeurs) {
        noeud_droit.donnees[valeur] = this.donnees[valeur]
      }
    }

    // Fils (uniquement pour noeuds internes)
    if (this.type == Noeud.INTERNE) {
      noeud_gauche.fils = this.fils[0..(i+1)] as ArrayList
      noeud_droit.fils = (this.fils - noeud_gauche.fils) as ArrayList
    }
    this.fils = [noeud_gauche, noeud_droit]

    // Pas de doublons entre noeuds internes
    if (this.type == Noeud.INTERNE) {
      noeud_droit.valeurs -= this.valeurs
    }

    // Modifie le noeud courant
    this.type = Noeud.INTERNE
    this.donnees = [:] // Un noeud interne n'a pas de données
  }

  /**
   * Fusionne un noeud fils avec son parent
   *
   * @author Médéric Hurier
   */
  private def fusionne(Noeud noeud) {
    // Supprime le fils avant la fusion
    this.fils.remove(noeud)

    // Fusion des données/fils
    this.valeurs += noeud.valeurs
    this.fils += noeud.fils
    this.donnees += noeud.donnees

    // Reparente
    this.fils.each { it.parent = this }

    // Tri et équilibre
    this.trier()
    this.equilibrerApresAjout()
    this.reparenter()
  }

  /**
   * Réorganise l'arbre en partant de la racine
   *
   * @todo améliorer la gestion en ne remontant que vers les noeuds impactés
   * @author Médéric Hurier
   */
  private def reparenter(monter=true) {
    if (parent && monter) this.parent.reparenter()

    // On change le parent avant de reparenter
    this.fils.each {
      it.parent = this
      it.reparenter(false)
    }
  }
}
