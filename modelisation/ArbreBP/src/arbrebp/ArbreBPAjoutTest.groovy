package arbrebp

/**
 * Test des fonctions d'ajout/recherche
 *
 * @author Médéric Hurier
 */
class ArbreBPAjoutTest {
  static def go() {
    println "Ordre pour l'arbre de test : 5"
    ArbreBP test = new ArbreBP(5)

    println "\nAjout de 5 valeurs dans l'arbre :"
    test.ajout(10, "D10")
    test.ajout(20, "D20")
    test.ajout(30, "D30")
    test.ajout(40, "D40")
    test.ajout(50, "D50")
    test.afficher()

    println "\nAprès premier éclatement :"
    test.ajout(60, "D60")
    test.ajout(70, "D70")
    test.ajout(80, "D80")
    test.afficher()

    println "\nAprès second éclatement :"
    test.ajout(90, "D90")
    test.ajout(35, "D35")
    test.ajout(36, "D36")
    test.ajout(37, "D37")
    test.afficher()

    println "\nAvant éclatement de la racine :"
    test.ajout(11, "D11")
    test.ajout(12, "D12")
    test.ajout(13, "D13")
    test.ajout(21, "D21")
    test.ajout(22, "D22")
    test.ajout(23, "D23")
    test.ajout(41, "D41")
    test.ajout(43, "D43")
    test.afficher()

    println "\nAprès éclatement de la racine :"
    test.ajout(42, "D42")
    test.afficher();
    
    println "\nRecherche valeur sur noeud feuille(11) :"
    println test.recherche(11)

    println "\nRecherche valeur sur noeud interne(40) :"
    println test.recherche(40)

    println "\nRecherche valeur inexistante(100) :"
    println test.recherche(100)
  }
}
