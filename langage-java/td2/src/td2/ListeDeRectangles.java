package td2;

/**
 *
 * @author freax
 */
public class ListeDeRectangles {
  public ElementListeRectangle premierElement;
  int nombre_elements;

  static int nombre_elements_total;
  static int nombre_liste;

  public ListeDeRectangles() {
    this.premierElement = null;
    this.nombre_liste++;
  }

  public void inserer(Rectangle r) {
    ElementListeRectangle e = new ElementListeRectangle(r, this.premierElement);
    this.premierElement = e;
    this.incrementeCompteur();
  }

  public boolean estVide() {
    return (this.premierElement == null) ? true : false;
  }

  public void toutesLesSurfaces() {
    ElementListeRectangle curseur = this.premierElement;
    
    while (curseur != null) {
      System.out.println("Surface du rectangle " + curseur.rect + " : " + curseur.rect.surface());
      curseur = curseur.suivant;
    }
  }

  public void incrementeCompteur() {
    this.nombre_elements++;
    ListeDeRectangles.nombre_elements_total++;
  }

  @Override
  public String toString() {
    String s = "";
    ElementListeRectangle curseur = this.premierElement;

    while (curseur != null) {
      s += curseur.rect + "\n";
      curseur = curseur.suivant;
    }

    return s;
  }
}
