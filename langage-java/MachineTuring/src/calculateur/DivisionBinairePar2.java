package calculateur;

import java.util.ArrayList;
import turing.*;

/**
 * Effectue une division binaire
 */
public class DivisionBinairePar2 extends Calculateur {
  
  public DivisionBinairePar2() {
    this.machine = new MachineTuring();
    ArrayList etats = this.machine.getEtats();
    TableTransition table = this.machine.getTable();
    
    // États
    Etat e0 = new Etat();
    Etat e1 = new Etat();
    Etat e2 = new EtatFinal();
    Etat e3 = new EtatFinal();
    etats.add(e0);
    etats.add(e1);
    etats.add(e2);
    etats.add(e2);
    this.machine.setEtatInitial(e0);
    
    // Transitions
    table.ajout(new Transition(e0, "0", e0, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "1", e0, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "$", e1, "$", Transition.Mouvement.GAUCHE));
    
    table.ajout(new Transition(e1, "0", e2, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e1, "1", e2, "1", Transition.Mouvement.GAUCHE));
    
    // Suppression de l'avant dernier chiffre
    table.ajout(new Transition(e2, "0", e3, "", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "1", e3, "", Transition.Mouvement.DROITE));
    
    table.ajout(new Transition(e3, "0", e3, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "1", e3, "1", Transition.Mouvement.DROITE));
  }
  
  @Override
  public String help() {
    StringBuilder str = new StringBuilder("Effectue une division binaire");
    str.append("\n1 1 1 0                 => 1 1 0");
    str.append("\n1 0 1 0 0 1             => 1 0 1 0 1");
    str.append("\n1 0 1                   => 1 1");
    str.append("\n");
    
    return str.toString();
  }
}
