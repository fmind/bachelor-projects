package turing;

import java.util.ArrayList;

/**
 * Une machine de Turing se compose:
 * - d'un ensemble d’états K
 * - d'un état initial s
 - - d'une fonction de transition delta
 * - d'un alphabet Sigma
 * - d'un ruban
 */
public class MachineTuring implements Executable {
  // États possibles pour la machine
  private Etat etatInitial;
  private Etat etatCourant;
  private ArrayList<Etat> etats;            // Doit contenir l'état initial
  // Transitions possibles pour la machine
  private TableTransition table;
  // Périphérique de lecture
  private Ruban ruban;
  // Compteur d'étapes
  private int compteur;
  
  // Symboles reconnus par la machine
  final static String alphabet[] = {"0", "1", "00", "11", "e", "E", "+", "x", "="};
  
  /**
   * Constructor
   */
  public MachineTuring() {
    this.etatInitial = null;
    this.etatCourant = null;
    this.table = new TableTransition();
    this.ruban = new Ruban();
    this.etats = new ArrayList<Etat>();
    this.compteur = 0;
  }
  
  @Override
  public void execute() {
    try {
      do {
        this.compteur++;
        this.step();
      } while (true);
    } catch (FinExecution e) {
      return;
    }
  }
  
  @Override
  public void reset() {
    this.etatCourant = this.etatInitial;
    this.compteur = 0;
  }
  
  @Override
  public void setMot(String mot) {
    this.reset();
    this.getRuban().setMot(mot);
    this.affiche();
  }
  
  /**
   * Étape d'exécution d'une machine
   * 
   * @throws Exception à la fin de l'exécution
   */
  @Override
  public void step() throws FinExecution {
    // Trouve la bonne transition
    Transition delta = this.getTable().recherche(this.etatCourant, this.getRuban().lecture());
    
    // Aucune transition trouvée
    if (delta == null) {
      throw new FinExecution("Aucune transition trouvée");
    }
    
    // Application de la transition
    this.setEtatCourant(delta.getEtatSuivant());
    this.getRuban().ecrire(delta.getSymboleEcrit());
    if (delta.getMouvement() == Transition.Mouvement.DROITE) {
      this.getRuban().avancer();
    } else if (delta.getMouvement() == Transition.Mouvement.GAUCHE) {
      this.getRuban().reculer();
    }

    this.affiche();
  }
  
  /**
   * Affiche l'état courant et le ruban pour vérifier l'exécution
   */
  public void affiche() {
    System.out.println("E: "+this.getEtatCourant()+"\t"+this.ruban);  
  }
  
  @Override
  public String toString() {
    StringBuilder str = new StringBuilder();
    
    // Alphabet
    str.append("Alphabet: ");
    for (String a : MachineTuring.alphabet) {
      str.append(a).append("|");
    }
    str.append("\n");
    
    // État
    str.append("États: ");
    for (Etat e : this.etats) {
      str.append(e).append("|");
    }
    str.append("\nÉtat initial: ").append(this.etatInitial);
    str.append("\n\n");
    
    // Transitions
    str.append(this.table);
    str.append("\n");
            
    // Ruban
    str.append(this.ruban);
    
    return str.toString();
  }
  
  /* Getters / Setters */
  @Override
  public boolean getResultat() {
    if (this.getEtatCourant() != null && this.getEtatCourant().valide())
      return true;
    return false;
  }
  
  /* Getters / Setters */
  
  public int getCompteur() {
    return this.compteur;
  }
  
  public Etat getEtatInitial() {
    return etatInitial;
  }

  public void setEtatInitial(Etat etatInitial) {
    this.etatInitial = etatInitial;
  }

  public Etat getEtatCourant() {
    return etatCourant;
  }

  private void setEtatCourant(Etat etatCourant) {
    this.etatCourant = etatCourant;
  }

  public ArrayList<Etat> getEtats() {
    return etats;
  }

  public Ruban getRuban() {
    return ruban;
  }

  public TableTransition getTable() {
    return table;
  }
}
