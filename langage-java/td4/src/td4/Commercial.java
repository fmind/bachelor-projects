package td4;

/**
 *
 * @author mederic
 */
public class Commercial extends Employe {
  private double salaire_fixe;
  private double chiffre_affaire;
  
  public Commercial(String nom, String prenom, int annee_embauche, double salaire_fixe) {
    super(nom, prenom, annee_embauche);
    
    this.salaire_fixe = salaire_fixe;
  }
  
  public void setChiffreAffaire(int chiffre_affaire) {
    this.chiffre_affaire = chiffre_affaire;
  }
  
  @Override
  public double getSupplement() {
    return chiffre_affaire * 0.01;
  }
  
  @Override
  public double getSalaireDeBase() {
    return this.salaire_fixe * 4;
  }
}
