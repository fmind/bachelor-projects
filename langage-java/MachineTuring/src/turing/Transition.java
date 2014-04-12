package turing;

/**
 * Si q est l'État courant et s est le symbole lu par la tête de lecture alors : 
 * => delta(q,s)=(p,r,D)
 * signifie que p est le nouvel État, 
 * que r est le symbole qui remplace s sur le ruban 
 * et que la tête de lecture se déplace de D (dans {G,D,I})
 */
public class Transition implements AvecMouvement {
  // Paramètres de delta()
  private Etat etatCourant;
  private String symboleLu;
  
  // Résultats de la fonction
  private Etat etatSuivant;
  private String symboleEcrit;
  private Mouvement mouvement;
  
  /**
   * Constructor
   * 
   * @param q état courant
   * @param s symbole lu
   * @param p état suivant
   * @param r symbole écrit
   * @param d mouvement
   */
  public Transition(Etat q, String s, Etat p, String r, Mouvement d) {
    this.etatCourant = q;
    this.symboleLu = s;
    this.etatSuivant = p;
    this.symboleEcrit = r;
    this.mouvement = d;
  }
  
  @Override
  public String toString() {
    return "delta("+this.etatCourant+","+this.symboleLu+") = ("+this.etatSuivant+","+this.symboleEcrit+","+this.mouvement+")";
  }

  /* Getters / Setters */
  
  public Etat getEtatCourant() {
    return etatCourant;
  }

  public Etat getEtatSuivant() {
    return etatSuivant;
  }

  public Mouvement getMouvement() {
    return mouvement;
  }

  public String getSymboleEcrit() {
    return symboleEcrit;
  }

  public String getSymboleLu() {
    return symboleLu;
  }
}
