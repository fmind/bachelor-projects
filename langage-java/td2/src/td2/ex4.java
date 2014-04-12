package td2;

/**
 *
 * @author freax
 */
public class ex4 {
  public static void main(String[] args) {
    Rectangle r1 = new Rectangle(0, 0, 1, 1);
    Rectangle r2 = new Rectangle(0, 0, 2, 2);
    Rectangle r3 = new Rectangle(0, 0, 3, 3);
    Rectangle r4 = new Rectangle(0, 0, 4, 4);
    Rectangle r5 = new Rectangle(0, 0, 5, 5);
    Rectangle r6 = new Rectangle(0, 0, 6, 6);
    
    ListeDeRectangles list1 = new ListeDeRectangles();
    ListeDeRectangles list2 = new ListeDeRectangles();

    list1.inserer(r1);
    list1.inserer(r2);
    list1.inserer(r3);

    list2.inserer(r4);
    list2.inserer(r5);

    System.out.println("Nombre d'éléments de la liste 1 : " + list1.nombre_elements);
    System.out.println("Nombre d'éléments de la liste 2 : " + list2.nombre_elements);
    System.out.println("Nombre d'éléments total : " + ListeDeRectangles.nombre_elements_total);
    System.out.println("Nombre de liste : " + ListeDeRectangles.nombre_liste);
  }
}
