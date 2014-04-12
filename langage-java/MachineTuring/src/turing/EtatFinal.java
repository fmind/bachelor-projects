package turing;

/**
 * État final d'une machine de Turing
 * les états finaux sont valides
 */
public class EtatFinal extends Etat {
  
  /**
   * Constructor
   */
  public EtatFinal() {
    super();
  }
  
  @Override
  public boolean valide() {
    return true;
  }
  
  @Override
  public String toString() {
    return super.toString() + "[F]";
  }
}
