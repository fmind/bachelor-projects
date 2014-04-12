package td1;

/**
 *
 * @author freax
 */
public class Biere {
  public String nom;
  public double degres;
  public Producteur producteur;

  static String goutBiere;

  public Biere() {
    this.nom = "";
    this.degres = 0;
    this.producteur = new Producteur();
  }

  public Biere(String nom, double degres) {
    this.nom = nom;
    this.degres = degres;
    this.producteur = new Producteur();
  }

  public Biere(String nom, double degres, Producteur producteur) {
    this.nom = nom;
    this.degres = degres;
    this.producteur = producteur;
  }

  public void opa(Biere b) {
    b.producteur = this.producteur;
  }

  public String toString() {
    return "Bière Nom : " + this.nom + ", degres : " + this.degres + ", gout : " +Biere.goutBiere + " - Producteur : " + this.producteur;
  }
}
