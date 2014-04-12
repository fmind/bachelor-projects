/**
 *
 * @author mederic
 */
public class VoitureDerivee extends Vehicule {
  private int nombreDePortes;
  
  public VoitureDerivee(boolean moteur, int vitesseMax, int nombreDePortes) {
    super(moteur, vitesseMax);
    this.nombreDePortes = nombreDePortes;
  }
  
  @Override
  public String toString() {
    return super.toString() + "Véhicule composé:" + this.nombreDePortes + " portes";
  }
}
