package td4;

/**
 *
 * @author mederic
 */
public class Technicien extends Employe {   
  private double salaire_horaire;
  private int nombre_heures;
  
  public Technicien(String nom, String prenom, int annee_embauche, int salaire_horaire) {
    super(nom, prenom, annee_embauche);
    
    this.salaire_horaire = salaire_horaire;
  }
  
  public void setNombreHeures(int heures) {
    this.nombre_heures = heures;
  }
  
  @Override
  public double getSupplement() {
    double heures_supplémentaires = (this.nombre_heures <= 35) ? 0 : this.nombre_heures - Employe.HEURES_LEGALES;
     
    return heures_supplémentaires * this.salaire_horaire * 1.30 * 4;
  }
  
  @Override
  public double getSalaireDeBase() {
    double heures_normales = (this.nombre_heures <= 35) ? this.nombre_heures : Employe.HEURES_LEGALES;
     
    return heures_normales * this.salaire_horaire * 4;
  }
}
