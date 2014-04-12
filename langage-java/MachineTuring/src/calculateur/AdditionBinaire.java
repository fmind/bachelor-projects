package calculateur;

import java.util.ArrayList;
import turing.*;

/**
 * Effectue une addition binaire
 * 
 * Le résultat est affiché à l'envers !
 */
public class AdditionBinaire extends Calculateur {
  
  public AdditionBinaire() {
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
    Etat e12 = new Etat();
    Etat e13 = new Etat();
    Etat e14 = new Etat();
    Etat e15 = new Etat();
    Etat e16 = new Etat();
    Etat e17 = new EtatFinal();
    Etat e18 = new Etat();
    Etat e19 = new Etat();
    Etat e20 = new Etat();
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
    etats.add(e13);
    etats.add(e14);
    etats.add(e15);
    etats.add(e16);
    etats.add(e17);
    etats.add(e18);
    etats.add(e19);
    etats.add(e20);
    this.machine.setEtatInitial(e0);
    
    // Transitions
    // Détermine si le premier nombre a été entièrement lu
    table.ajout(new Transition(e0, "0", e1, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "1", e1, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "e", e0, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e0, "+", e15, "+", Transition.Mouvement.DROITE));

    table.ajout(new Transition(e1, "0", e1, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e1, "1", e1, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e1, "e", e2, "e", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e1, "+", e2, "+", Transition.Mouvement.GAUCHE));
 
    // Chiffre du premier nombre : 0 ou 1
    table.ajout(new Transition(e2, "0", e3, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e2, "1", e7, "e", Transition.Mouvement.DROITE));
    
    // Chemin 0
    table.ajout(new Transition(e3, "e", e3, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e3, "+", e4, "+", Transition.Mouvement.DROITE));

    table.ajout(new Transition(e4, "0", e5, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "1", e5, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e4, "e", e11, "e", Transition.Mouvement.DROITE));
    
    table.ajout(new Transition(e5, "0", e5, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e5, "1", e5, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e5, "e", e6, "e", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e5, "=", e6, "=", Transition.Mouvement.GAUCHE));
    
    // Chifre du second nombre à aditionner avec 0 : 0 ou 1
    table.ajout(new Transition(e6, "0", e11, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e6, "1", e12, "e", Transition.Mouvement.DROITE));
    
    // Chemin 1
    table.ajout(new Transition(e7, "e", e7, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e7, "+", e8, "+", Transition.Mouvement.DROITE));

    table.ajout(new Transition(e8, "0", e9, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "1", e9, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e8, "e", e12, "e", Transition.Mouvement.DROITE));
    
    table.ajout(new Transition(e9, "0", e9, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e9, "1", e9, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e9, "e", e10, "e", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e9, "=", e10, "=", Transition.Mouvement.GAUCHE));
    
    // Chiffre du second nombre à aditionner avec 1 : 0 ou 1
    table.ajout(new Transition(e10, "0", e12, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e10, "1", e13, "e", Transition.Mouvement.DROITE));
    
    // Écriture du chiffre 0 dans le résultat (0+0)
    table.ajout(new Transition(e11, "0", e11, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e11, "1", e11, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e11, "11", e11, "11", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e11, "e", e11, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e11, "=", e11, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e11, "$", e14, "0", Transition.Mouvement.GAUCHE));
    
    // Écriture du chiffre 1 dans le résultat (1+0 ou 0+1)
    table.ajout(new Transition(e12, "0", e12, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e12, "1", e12, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e12, "11", e12, "11", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e12, "e", e12, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e12, "=", e12, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e12, "$", e14, "1", Transition.Mouvement.GAUCHE));
    
    // Écriture du chiffre 11 ou retenu dans le résultat (1+1)
    table.ajout(new Transition(e13, "0", e13, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e13, "1", e13, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e13, "11", e13, "11", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e13, "e", e13, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e13, "=", e13, "=", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e13, "$", e14, "11", Transition.Mouvement.GAUCHE));
    
    // Rembobine le ruban jusqu'à l'état initial
    table.ajout(new Transition(e14, "0", e14, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e14, "1", e14, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e14, "11", e14, "11", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e14, "e", e14, "e", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e14, "+", e14, "+", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e14, "=", e14, "=", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e14, "$", e0, "$", Transition.Mouvement.DROITE));
    
    // Détermine si le calcul est fini, ou si il reste des chiffres dans le second nombre 
    table.ajout(new Transition(e15, "0", e5, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e15, "1", e5, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e15, "e", e15, "e", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e15, "=", e16, "=", Transition.Mouvement.DROITE));
    
    // Test les zéros finaux et les retenus dans le résultat
    table.ajout(new Transition(e16, "0", e16, "0", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e16, "1", e16, "1", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e16, "11", e18, "11", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e16, "$", e17, "$", Transition.Mouvement.GAUCHE));
    
    // Enlève les 0 finaux
    table.ajout(new Transition(e17, "0", e17, "", Transition.Mouvement.IMMOBILE));
    
    // Nombre suivant la retenue (0, 1 ou 11)
    table.ajout(new Transition(e18, "0", e19, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e18, "1", e19, "11", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e18, "11", e18, "11", Transition.Mouvement.DROITE));
    table.ajout(new Transition(e18, "$", e19, "1", Transition.Mouvement.GAUCHE));
    
    // Transforme la retenu 11 en 0
    table.ajout(new Transition(e19, "11", e20, "0", Transition.Mouvement.GAUCHE));
    
    // Écrit le nombre suivant la retenue (0 11 => 1 0, 1 11 => 11 0, $ 11 => 1 0)
    table.ajout(new Transition(e20, "0", e20, "0", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e20, "1", e20, "1", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e20, "11", e20, "11", Transition.Mouvement.GAUCHE));
    table.ajout(new Transition(e20, "=", e16, "=", Transition.Mouvement.DROITE));
  }
  
  @Override
  public String help() {
    StringBuilder str = new StringBuilder("Effectue une addition binaire");
    str.append("\n!! Le résultat est affiché à l'envers !!");
    str.append("\n1 0 + 0 1 =               Nombres de même longeur => 1 1");
    str.append("\n1 0 1 0 + 1 =             Nombre gauche plus long => 1 1 0 1");
    str.append("\n0 + 1 1 0 1 =             Nombre droite plus long => 1 0 1 1");
    str.append("\n1 0 + 0 0 1 1 0 0 1 =     Enlève les zéro finaux au résultat => 1 1 0 1 1");
    str.append("\n + 1 0 =                  Manque nombre gauche => échec");
    str.append("\n1 0 + =                   Manque nombre droit => échec");
    str.append("\n1 0 1 0 =                 Manque + => échec");
    str.append("\n1 0 + 1 0                 Manque = => échec");
    str.append("\n1 0 1 0                   Manque signes => échec");
    str.append("\n1 0 1 + 1 =               Retenu suivi de 0 => 0 1 1");
    str.append("\n1 0 0 + 1 0 0 =           Retenu suivi de $ => 0 0 0 1");
    str.append("\n1 1 0 1 + 1 0 1 =         Retenu suivi de 1 => 0 1 0 0 1");
    str.append("\n1 1 1 + 1 1 =             Retenu suivi de 11 => 0 1 0 1");
    str.append("\n1 1 0 1 1 + 1 1 0 1 1 =   Nombre plus complexe => 0 1 1 0 1 1");
    str.append("\n");
    
    return str.toString();
  }
}
