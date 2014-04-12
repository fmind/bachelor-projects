package td4;

/**
 *
 * @author mederic
 */
public class Exercice2 {
  
  /**
   * @param args the command line arguments
   */
  public static void main(String[] args) {
    CompteOffshore cb1 = new CompteOffshore(3615, "Médéric Hurier", "fr", 100);
    System.out.println(cb1.getSolde());
    cb1.afficherNumero();
  }  
}
