package td4;

/**
 *
 * @author mederic
 */
public class Exercice3 {
  
  /**
   * @param args the command line arguments
   */
  public static void main(String[] args) {
    Technicien e1 = new Technicien("Naimar", "Jean", 1996, 10);
    e1.setNombreHeures(35);
    
    Technicien e2 = new Technicien("Quiroulle", "Pierre", 2002, 12);
    e2.setNombreHeures(38);
    
    Commercial e3 = new Commercial("Suffy", "Sam", 1999, 450);
    e3.setChiffreAffaire(16347);
    
    e1.afficheSalaire();
    e2.afficheSalaire();
    e3.afficheSalaire();
  }  
}
