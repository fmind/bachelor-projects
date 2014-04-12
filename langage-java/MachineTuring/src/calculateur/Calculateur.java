package calculateur;

import turing.MachineTuring;
import turing.Executable;
import turing.FinExecution;

/**
 * Un calculateur utilise une machine de Turing initialisée avec un mot pour effectuer une opération
 */
public abstract class Calculateur implements Executable {
  protected MachineTuring machine;      // Machine de Turing pour l'exécution
  private boolean timing;               // Active le temps d'exécution des machines
  
  /**
   * Constructor
   */
  public Calculateur() {
    this.machine = null;
    this.timing = true;
  }
  
  /**
   * Constructor
   * 
   * @param timing active la fonction de profiling
   */
  public Calculateur(boolean timing) {
    super();
    this.timing = timing;
  }
  
  @Override
  public void execute() {
    System.out.println("\nRUN:");
    long start = System.currentTimeMillis();
    
    this.machine.execute();
    
    if (this.timing) {
      long end = System.currentTimeMillis();
      System.out.println("Temps d'exécution: "+String.valueOf(end-start)+"ms");
      System.out.println("Nombre d'étapes: "+this.machine.getCompteur());
    }
  }
  
  @Override
  public void step() throws FinExecution {
    try {
      this.machine.step();
    } catch (FinExecution err) {
      throw err;
    }
  }
  
  @Override
  public void reset() {
    this.machine.reset();
  }
  
  @Override
  public void setMot(String mot) {
    this.machine.setMot(mot);
  }
  
  @Override
  public boolean getResultat() {
    return this.machine.getResultat();
  }
  
  /**
   * Affiche les paramètres de la machine
   */
  public void affiche() {
    System.out.println("Configuration de la machine:");
    System.out.println(this.machine);
  }
  

  /**
   * Enclenche l'affichage du temps d'exécution
   * 
   * @param timing vrai pour enclencher l'affichage du temps
   */
  public void setTiming(boolean timing) {
    this.timing = timing;
  }
  
  /**
   * Affiche l'aide du calculateur
   * Chaque calculateur doit retourner son propre message d'erreur
   * 
   * @return message d'aide 
   */
  public abstract String help();
}
