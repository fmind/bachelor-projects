package calculateur;

import java.util.ArrayList;
import turing.*;

/**
 * Effectue une multiplication binaire
 */
public class MultiplicationBinaire extends Calculateur{
  
  public MultiplicationBinaire() {
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
    Etat e7 = new Etat();
    Etat e8 = new Etat();
    Etat e9 = new Etat();
    Etat e10 = new Etat();
    Etat e11 = new Etat();
    Etat e12 = new EtatFinal();
    etats.add(e0);
    etats.add(e2);
    etats.add(e3);
    etats.add(e4);
    etats.add(e5);
    etats.add(e6);
    etats.add(e7);
    etats.add(e8);
    etats.add(e9);
    etats.add(e10);
    etats.add(e11);
    etats.add(e12);
    this.machine.setEtatInitial(e0);
    
    // Transitions
    // Utilise le dernier chiffre du premier terme
    table.ajout(new Transition(e0, "0", e0, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "1", e0, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "e", e1, "e", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e0, "x", e1, "x", Transition.Mouvement.GAUCHE));
    
    table.ajout(new Transition(e1, "0", e0, "e", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e1, "1", e2, "E", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e1, "$", e10, "$", Transition.Mouvement.DROITE));
    
    // Ajoute le deuxième terme au résultat
    table.ajout(new Transition(e2, "0", e3, "00", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "1", e4, "11", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "e", e2, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "x", e2, "x", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "=", e6, "=", Transition.Mouvement.GAUCHE));
    
    table.ajout(new Transition(e3, "0", e3, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "1", e3, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "+", e3, "+", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "=", e3, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "$", e5, "0", Transition.Mouvement.GAUCHE));
    
    table.ajout(new Transition(e4, "0", e4, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "1", e4, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "+", e4, "+", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "=", e4, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "$", e5, "1", Transition.Mouvement.GAUCHE));
    
    // Rembobine jusqu'au deuxième terme
    table.ajout(new Transition(e5, "0", e5, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e5, "1", e5, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e5, "+", e5, "+", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e5, "x", e2, "x", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e5, "=", e5, "=", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e5, "00", e2, "00", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e5, "11", e2, "11", Transition.Mouvement.DROITE));
    
    // Décale le résultat en rajouter des 0
    table.ajout(new Transition(e6, "0", e6, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "1", e6, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "00", e6, "00", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "11", e6, "11", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "e", e7, "E", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e6, "E", e6, "E", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "+", e6, "+", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "x", e6, "x", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "=", e6, "=", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e6, "$", e8, "$", Transition.Mouvement.DROITE));
    
    table.ajout(new Transition(e7, "0", e7, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "1", e7, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "00", e7, "00", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "11", e7, "11", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "E", e7, "E", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "+", e7, "+", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "x", e7, "x", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "=", e7, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "$", e6, "0", Transition.Mouvement.GAUCHE));

    // Rembobine le ruban, en remplacant les caractères utilitaires
    table.ajout(new Transition(e8, "0", e8, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "1", e8, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "00", e8, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "11", e8, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "E", e8, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "+", e8, "+", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "x", e8, "x", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "=", e8, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "$", e9, "+", Transition.Mouvement.GAUCHE));
    
    table.ajout(new Transition(e9, "0", e9, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e9, "1", e9, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e9, "e", e9, "e", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e9, "+", e9, "+", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e9, "x", e9, "x", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e9, "=", e9, "=", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e9, "$", e0, "$", Transition.Mouvement.DROITE));
    
    // Remplace le dernier + par un signe vide
    table.ajout(new Transition(e10, "0", e10, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e10, "1", e10, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e10, "e", e10, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e10, "x", e10, "x", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e10, "=", e10, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e10, "+", e10, "+", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e10, "$", e11, "$", Transition.Mouvement.GAUCHE));
    
    table.ajout(new Transition(e11, "+", e12, "", Transition.Mouvement.GAUCHE));
  }
  
  @Override
  public String help() {
    StringBuilder str = new StringBuilder("Effectue une multiplication binaire");
    str.append("\n1 x 1 1 0 1 =             Simple multiplication => 1 1 0 1");
    str.append("\n1 0 0 x 1 1 0 1 =         Avec moins d'un 1 dans un terme => 1 1 0 1 0 0");
    str.append("\n1 1 1 x 1 1 0 1 =         Somme d'additions pour les multiplications complexes => 1 1 0 1 + 1 1 0 1 0 + 1 1 0 1 0 0");
    str.append("\n");
    
    return str.toString();
  }
}
