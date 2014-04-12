package turing;

/**
 * État d'une machine de Turing
 * par défaut, un état n'est pas valide
 */
public class Etat {
  private int id;               // Identifiant unique pour un état
  
  private static int serial;    // Compteur auto incrémenté pour les ID
  
  /**
   * Constructor
   */
  public Etat() {
    this.id = Etat.serial++;
  }
  
  /**
   * Remet à zéro le compteur interne pour faciliter la création de classes
   */
  public static void resetSerial() {
    Etat.serial = 0;
  }
  
  /**
   * Compare deux états
   * 
   * @param e état à comparer
   * @return vrai si les identifiants sont égaux
   */
  public boolean equals(Etat e) {
    if (this.id == e.id) {
      return true;
    }
    
    return false;
  }
  
  /**
   * Test si l'état est valide pour l'exécution de la machine
   * 
   * @return vrai si l'état est valide pour la machine 
   */
  public boolean valide() {
    return false;
  }
  
  @Override
  public String toString() {
    return String.valueOf(this.id);
  }
}
