package calculateur;

import java.util.ArrayList;
import turing.*;

/**
 * Décale un mot binaire de la taille du mot lu
 */
public class Decaleur extends Calculateur {
  
  public Decaleur() {
    this.machine = new MachineTuring();
    ArrayList etats = this.machine.getEtats();
    TableTransition table = this.machine.getTable();
    
    // États
    Etat e0 = new Etat();
    Etat e1 = new Etat();
    Etat e2 = new Etat();
    Etat e3 = new Etat();
    Etat e4 = new Etat();
    Etat e5 = new Etat();
    Etat e6 = new Etat();
    Etat e7 = new EtatFinal();
    etats.add(e0);
    etats.add(e1);
    etats.add(e2);
    etats.add(e3);
    etats.add(e4);
    etats.add(e5);
    etats.add(e6);
    this.machine.setEtatInitial(e0);
    
    // Transitions
    // Swtich 0 ou 1
    table.ajout(new Transition(e0, "0", e1, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "1", e3, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "e", e7, "", Transition.Mouvement.DROITE));
    
    // Chemin 0
    //partie lue
    table.ajout(new Transition(e1, "0", e1, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e1, "1", e1, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e1, "$", e1, "e", Transition.Mouvement.IMMOBILE));
    table.ajout(new Transition(e1, "e", e2, "e", Transition.Mouvement.DROITE));
    //partie écrite
    table.ajout(new Transition(e2, "0", e2, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "1", e2, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "$", e5, "0", Transition.Mouvement.GAUCHE));
    
    // Chemin 1
    // partie lue
    table.ajout(new Transition(e3, "0", e3, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "1", e3, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "$", e3, "e", Transition.Mouvement.IMMOBILE));
    table.ajout(new Transition(e3, "e", e4, "e", Transition.Mouvement.DROITE));
    // partie écrite
    table.ajout(new Transition(e4, "0", e4, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "1", e4, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "$", e5, "1", Transition.Mouvement.GAUCHE));
    
    // Rembobinage de la partie écrite
    table.ajout(new Transition(e5, "0", e5, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e5, "1", e5, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e5, "e", e6, "e", Transition.Mouvement.GAUCHE));
    
    // Rembobinage de la partie lue
    table.ajout(new Transition(e6, "0", e6, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "1", e6, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "e", e0, "e", Transition.Mouvement.DROITE));
  }
  
  @Override
  public String help() {
    StringBuilder str = new StringBuilder("Décale un mot binaire de la taille du mot lu");
    str.append("\n0 1 0                   OK => e e e 0 1 0");
    str.append("\n1 1 0 0 1 0 1           OK => e e e e e e e e 1 1 0 0 1 0 1");
    str.append("\n0 1 e 1 1               OK => e e 1 1 0 1");
    str.append("\n");
    
    return str.toString();
  }
}
