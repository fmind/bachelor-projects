/**
 *
 * @author mederic
 */
public class Vehicule {
  private boolean moteur;
  private int vitesseMax;
  
  public Vehicule(boolean moteur, int vitesseMax) {
    this.moteur = moteur;
    this.vitesseMax = vitesseMax;
  }
  
  public void vMax() {
    System.out.println(vitesseMax);
  }
  
  @Override
  public String toString() {
    if (this.moteur) {
      return "Voiture avec moteur: "+this.vitesseMax+"km/h";
    } else {
      return "Voiture sans moteur: "+this.vitesseMax+"km/h";
    }
  }
}
