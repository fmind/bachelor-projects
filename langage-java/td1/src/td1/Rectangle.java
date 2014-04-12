package td1;

/**
 *
 * @author freax
 */
public class Rectangle {
  public Point inferieurGauche;
  public Point superieurDroit;

  public Rectangle(Point p1, Point p2) {
    this.inferieurGauche = p1;
    this.superieurDroit = p2;
  }

  public int surface() {
    int longueur = this.superieurDroit.x - this.inferieurGauche.x;
    int largeur = this.superieurDroit.y - this.inferieurGauche.y;

    return longueur * largeur;
  }

  public String toString() {
    return "p1:" + this.inferieurGauche + " - p2:" + this.superieurDroit;
  }
}
