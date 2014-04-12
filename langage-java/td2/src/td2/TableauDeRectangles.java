package td2;

/**
 *
 * @author freax
 */
public class TableauDeRectangles {
  public Rectangle[] tableau;

  public TableauDeRectangles() {
    this.tableau = new Rectangle[10];
  }

  public TableauDeRectangles(int n) {
    this.tableau = new Rectangle[n];
  }

  public void set(int i, Rectangle r) {
    this.tableau[i] = r;
  }

  public void inserer(int i, Rectangle r) {
    if (i < this.tableau.length && i >= 0) {
      if (this.tableau[i] == null) {
        this.tableau[i] = r;
      } else {
        Rectangle rectangle_deplace = this.tableau[i];
        this.set(i, r);
        this.inserer(i+1, rectangle_deplace);
      }
    }
  }

  public boolean rechercher(Rectangle rect) {
    for (Rectangle r : this.tableau) {
      if (r != null && rect.compareTo(r) == 0) return true;
    }
    return false;
  }

  public void ToutesLesSurfaces() {
    for (Rectangle r : this.tableau) {
      if (r != null) {
        System.out.println("Surface du rectangle " + r + " : " + r.surface());
      }
    }
  }

  public String toString() {
    String s = "";
    for (int i = 0; i < this.tableau.length; i++) {
      s += this.tableau[i] + "\n";
    }
    return s;
  }
}
