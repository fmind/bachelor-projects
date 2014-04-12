/**
 *
 * @author mederic
 */
public class VoitureComposee {
  private Vehicule  ve;
  private int nombrePortes;
  
  public VoitureComposee(int nombrePortes) {
    this.ve = ve;
    this.nombrePortes = nombrePortes;
  }
  
  @Override
  public String toString() {
    return "Véhicule composé:" + this.ve + " pour "+this.nombrePortes + " portes";
  }

  public Vehicule getVe() {
    return ve;
  }

  public void setVe(Vehicule ve) {
    this.ve = ve;
  }
}
