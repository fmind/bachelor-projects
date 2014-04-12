package arbrebp

/**
 * Représente un arbre B+
 *
 * adaptateur à la classe noeud
 * 
 * @author Médéric Hurier
 */
class ArbreBP {
  int ordre
  int indent    // Niveau d'indentation lors de l'affichage
  Noeud racine

  ArbreBP(int ordre, int indent = 4) {
    this.ordre = ordre
    this.indent = indent
    this.racine = new Noeud(ordre, Noeud.FEUILLE)
  }

  def recherche(valeur) {
    return racine.recherche(valeur)
  }

  def ajout(valeur, donnee) {
    this.racine.ajout(valeur, donnee)
  }

  def suppression(valeur) throws ArbreException {
    this.racine.suppression(valeur)
  }

  def afficher() {
    this.racine.afficher(this.indent)
  }
}