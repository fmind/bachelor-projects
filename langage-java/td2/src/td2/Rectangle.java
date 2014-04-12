package td2;

/**
 *
 * @author freax
 */
public class Rectangle {
  public Point inferieurGauche;
  public Point superieurDroit;

  public Rectangle() {
    this.inferieurGauche = new Point(0,0);
    this.superieurDroit = new Point(1,1);
  }

  public Rectangle(Point p1, Point p2) {
    this.inferieurGauche = p1;
    this.superieurDroit = p2;
  }

  public Rectangle(int x1, int y1, int x2, int y2) {
    this(new Point(x1, y1), new Point(x2, y2));
  }

  public Rectangle copie() {
    return new Rectangle(this.inferieurGauche.copie(), this.superieurDroit.copie());
  }

  public int surface() {
    int longueur = this.superieurDroit.x - this.inferieurGauche.x;
    int largeur = this.superieurDroit.y - this.inferieurGauche.y;

    return longueur * largeur;
  }

  public void translater(int a, int b) {
    this.inferieurGauche.deplacer(a, b);
    this.superieurDroit.deplacer(a, b);
  }

  public int compareTo(Rectangle r) {
    return inferieurGauche.compareTo(r.inferieurGauche);
  }

  @Override
  public String toString() {
    return "p1:" + this.inferieurGauche + " - p2:" + this.superieurDroit;
  }
}
