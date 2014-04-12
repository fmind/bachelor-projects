/**
 *
 * @author mederic
 */
public class Tasse {
  private Liquide liquide;
  
  public Tasse() {
    this.liquide = null;
  }
  
  public void ajouterLiquide(Liquide li) {
    this.liquide = li;
  }
  
  public void imprimer() {
    this.liquide.imprimer();
  }
}
