package td2;

/**
 *
 * @author freax
 */
public class ElementListeRectangle {
  Rectangle rect;
  ElementListeRectangle suivant;

  public ElementListeRectangle(Rectangle rect) {
    this.rect = rect;
    this.suivant = null;
  }

  public ElementListeRectangle(Rectangle rect, ElementListeRectangle suivant) {
    this.rect = rect;
    this.suivant = suivant;
  }
}
