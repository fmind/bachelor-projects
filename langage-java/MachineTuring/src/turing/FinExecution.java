package turing;

/**
 * Exception levée par une machine de Turing à la fin de l'exécution
 */
public class FinExecution extends Exception {

  /**
   * Constructor
   * 
   * @param message message d'erreur
   */
  public FinExecution(String message) {
    super(message);
  }
  
  @Override
  public String toString() {
    return this.toString();
  }
}
