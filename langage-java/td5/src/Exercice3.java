/**
 *
 * @author mederic
 */
public class Exercice3 {
  public static void main(String[] args) {
    Tasse tasses[] = new Tasse[5];
    
    Tasse t1 = new Tasse();
    t1.ajouterLiquide(new Cafe());
    tasses[0] = t1;
    
    Tasse t2 = new Tasse();
    t2.ajouterLiquide(new Lait());
    tasses[1] = t2;
    
    Tasse t3 = new Tasse();
    t3.ajouterLiquide(new Lait());
    tasses[2] = t3;
    
    Tasse t4 = new Tasse();
    t4.ajouterLiquide(new Cafe());
    tasses[3] = t4;
    
    Tasse t5 = new Tasse();
    t5.ajouterLiquide(new Lait());
    tasses[4] = t5;
    
    for (int i = 0; i < tasses.length; i++) {
      tasses[i].imprimer();
    }
  }
}
