package td1;

/**
 *
 * @author freax
 */
public class Producteur {
  public String nom;
  public String adresse;

  public Producteur() {
    this.nom = "";
    this.adresse = "";
  }

  public Producteur(String nom) {
    this.nom = nom;
    this.adresse = "";
  }

  public Producteur(String nom, String adresse) {
    this.nom = nom;
    this.adresse = adresse;
  }

  public String toString() {
    return "nom : " + this.nom + ", adresse : " + this.adresse;
  }
}
