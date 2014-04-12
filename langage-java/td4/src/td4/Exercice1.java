package td4;

/**
 *
 * @author mederic
 */
public class Exercice1 {

  /**
   * @param args the command line arguments
   */
  public static void main(String[] args) {
    /*
    // Les accesseurs publics ne sont pas adaptés, car non sécurisés
    CompteBancaire cb1 = new CompteBancaire();
    cb1.nom = "Médéric Hurier";
    cb1.numero = 3615;
    cb1.solde = 1000000000;
    System.out.println(cb1);
    */
    
    // Les attributs modifiables sont accessibles uniquement par des méthodes
    CompteBancaire cb2 = new CompteBancaire(3615, "Médéric Hurier");
    cb2.setSolde(1000000000);
    cb2.crediter(500);
    cb2.debiter(1000);
    System.out.println(cb2);
  }
}
