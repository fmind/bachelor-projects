package td4;

/**
 *
 * @author mederic
 */
public class CompteOffshore extends CompteBancaire {
  private String pays;

  public CompteOffshore(int numero, String nom, String pays, int solde) {
    super(numero, nom);
    this.setSolde(solde);
    this.pays = pays;
  }
  
  public void afficherNumero() {
    System.out.println("Numéro de compte: "+this.numero);
  }
}
