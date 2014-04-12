/**
 *
 * @author mederic
 */
public class Exercice2 {
  public static void main(String[] args) {
    // On accède aux attributs de véhicule en passant par les attributs de la composition
    Vehicule v = new Vehicule(false, 200);
    VoitureComposee vc = new VoitureComposee(4);
    vc.setVe(v);
    
    // On accède directement aux attributs de la voiture de manière transparente
    VoitureDerivee vd = new VoitureDerivee(true, 100, 4);
  }
}
