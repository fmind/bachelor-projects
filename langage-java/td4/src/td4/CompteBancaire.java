package td4;

/**
 *
 * @author mederic
 */
public class CompteBancaire {
  protected int numero;
  protected String nom;
  protected int solde;

  public CompteBancaire(int numero, String nom) {
    this.numero = numero;
    this.nom = nom;
  }
  
  public void debiter(int sous) {
    this.solde += sous;
  }
  
  public void crediter(int sous) {
    this.solde -= sous;
  }
  
  public String getNom() {
    return nom;
  }

  public int getNumero() {
    return numero;
  }

  public int getSolde() {
    return solde;
  }

  public void setSolde(int solde) {
    this.solde = solde;
  }
  
  @Override
  public String toString() {
    return "Numéro: "+numero+", Nom: "+nom+", Solde: "+solde; 
  }
}
