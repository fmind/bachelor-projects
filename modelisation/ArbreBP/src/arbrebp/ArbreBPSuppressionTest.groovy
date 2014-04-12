package arbrebp

/**
 * Test des fonctions de suppression
 *
 * @author Maxime Bruant
 */
class ArbreBPSuppressionTest {
  static def go() {
    ArbreBP test = new ArbreBP(4)

    println "Test suppression"

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
    test.ajout(65, "D65")
    test.afficher()
  
    println "\nAprès éclatement de la racine :"
    test.ajout(42, "D42")
    test.afficher();
    test.suppression(36);
    println "\nApr�s suppression de 36"
    test.afficher();
    test.suppression(70);
    println "\nApr�s suppression de 70"
    test.afficher();
    test.suppression(80);
    println "\nApr�s suppression de 80"
    test.afficher();
    test.suppression(60);
    println "\nApr�s suppression de 60"
    test.afficher();
    test.suppression(43);
    println "\nApr�s suppression de 43"
    test.afficher();
    test.suppression(42);
    println "\nApr�s suppression de 42"
    test.afficher();
    test.suppression(22);
    println "\nApr�s suppression de 22"
    test.afficher();
    test.suppression(12);
    println "\nApr�s suppression de 12"
    test.afficher();
    test.suppression(10);
    println "\nApr�s suppression de 10"
    test.afficher();
    test.suppression(11);
    println "\nApr�s suppression de 11"
    test.afficher();
    test.suppression(13);
    println "\nApr�s suppression de 13"
    test.afficher();
    test.suppression(30);
    println "\nApr�s suppression de 30"
    test.afficher();
    test.suppression(20);
    println "\nApr�s suppression de 20"
    test.afficher();
  }
}