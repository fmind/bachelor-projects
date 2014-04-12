package turing;

import java.util.ArrayList;

/**
 * Stocke les transitions possibles pour une machine de Turing
 */
public class TableTransition {
  // Structure interne
  private ArrayList<Transition> liste;
  
  /**
   * Constructor
   */
  public TableTransition() {
    this.liste = new ArrayList<Transition>();
  }
  
  /**
   * Ajoute une transition à la liste
   * 
   * @param delta une transition
   */
  public void ajout(Transition delta) {
    this.liste.add(delta);
  }
  
  /**
   * Recherche une transition dans la table pour un état et un symbole
   * 
   * @note retourne la première transition trouvée
   * @param q etat courant
   * @param s symbole lu
   * 
   * @return la transition trouvée ou null
   */
  public Transition recherche(Etat q, String s) {
    for (Transition delta : this.liste) {
      if (delta.getEtatCourant().equals(q) && delta.getSymboleLu().equals(s)) {
        return delta;
      }
    }
    
    return null;
  }
  
  @Override
  public String toString() {
    StringBuilder str = new StringBuilder();
    str.append("Table de transition:\n");
    
    for (Transition delta : this.liste) {
      str.append(delta).append("\n");
    }
    
    return str.toString();
  }
}
