package calculateur;

import java.util.ArrayList;
import turing.*;

/**
 * Transforme deux mots binaires séparés par un "e" en: 1nE0n
 */
public class Un_E_Zero extends Calculateur {
  
  public Un_E_Zero() {
    this.machine = new MachineTuring();
    ArrayList etats = this.machine.getEtats();
    TableTransition table = this.machine.getTable();
    
    // États
    Etat e0 = new Etat();
    Etat e1 = new EtatFinal();
    etats.add(e0);
    etats.add(e1);
    this.machine.setEtatInitial(e0);
    
    // Transitions
    // Remplacement des 0 par des 1
    table.ajout(new Transition(e0, "0", e0, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "1", e0, "1", Transition.Mouvement.DROITE));
    
    // Changement de comportement
    table.ajout(new Transition(e0, "e", e1, "e", Transition.Mouvement.DROITE));
    
    // Remplacement des 1 par des 0
    table.ajout(new Transition(e1, "0", e1, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e1, "1", e1, "0", Transition.Mouvement.DROITE));
  }
  
  @Override
  public String help() {
    StringBuilder str = new StringBuilder("Transforme deux mots binaires séparés par un 'e' en: 1nE0n");
    str.append("\n0 0 0 0 e 1 1 1 1       OK => 1 1 1 1 e 0 0 0 0");
    str.append("\n1 1 1 1 e 1 1 1 1       OK => 1 1 1 1 e 0 0 0 0");
    str.append("\n0 1                     Échec => manque E");
    str.append("\n");
    
    return str.toString();
  }
}
