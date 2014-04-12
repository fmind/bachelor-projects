package turing;

/**
 * Regroupe les constantes de mouvement pouvant être réalisés par une machine de Turing
 */
public interface AvecMouvement {
  public final static String GAUCHE   = "G";
  public final static String IMMOBILE = "I";
  public final static String DROITE   = "D";
  
  // Regroupe les possibilités dans un type Enum
  public static enum Mouvement {
    GAUCHE, IMMOBILE, DROITE
  }
}
  