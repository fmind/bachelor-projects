package turing;

/**
 * Interface d'un objet exécutable
 */
public interface Executable {
  
  /**
   * Exécution en une fois
   */
  public void execute();
  
  /**
   * Exécution étape par étape
   * 
   * @throws FinExecution levé en fin d'exécution
   */
  public void step() throws FinExecution;
          
  /**
   * Remet à zéro l'objet
   */
  public void reset();
  
  /**
   * Change le mot sur le ruban
   * 
   * @param mot mot à écrire sur le ruban
   */
  public void setMot(String mot);
  
  /**
   * Affiche le résultat de l'exécution
   * 
   * @return vrai si l'exécution a réussi
   */
  public boolean getResultat();
}
