package td4;

import java.text.SimpleDateFormat;
import java.util.Date;

/**
 *
 * @author mederic
 */
public abstract class Employe {
  private String nom;
  private String prenom;
  private int annee_embauche;

  final static int HEURES_LEGALES = 35;
  
  public Employe(String nom, String prenom, int annee_embauche) {
    this.nom = nom;
    this.prenom = prenom;
    this.annee_embauche = annee_embauche;
  }
  
  public int getAnciennete() {
    Date d = new Date();
    SimpleDateFormat f = new SimpleDateFormat("yyyy");
    int anciennete = Integer.parseInt(f.format(d)) - this.annee_embauche;

    return anciennete;
  }
  
  public double getPrimeAnciennete() {
    double salaire_avant_prime = this.getSalaireDeBase() + this.getSupplement();
    double prime = 0;
    
    for (int i=1; i<=this.getAnciennete(); i++) {
      prime += salaire_avant_prime * 0.8 / 100;
    }
    
    return prime;
  }
  
  public double getSalaire() {
    double salaire_base = this.getSalaireDeBase();
    double supplement = this.getSupplement();
    double prime_anciennete = this.getPrimeAnciennete();
    
    return salaire_base + supplement + prime_anciennete;
  }
  
  public void afficheSalaire() {
    System.out.println(this.nom+" "+this.prenom);
    System.out.println("Salaire de base: "+this.getSalaireDeBase());
    System.out.println("Année d'embauche: "+this.annee_embauche);
    System.out.println("Ancienneté: "+this.getAnciennete());
    System.out.println("Prime d'ancienneté: "+this.getPrimeAnciennete());
    System.out.println("Supplément: "+this.getSupplement());
    System.out.println("Total: "+this.getSalaire());
  }
  
  abstract public double getSupplement();
  abstract public double getSalaireDeBase();
}
