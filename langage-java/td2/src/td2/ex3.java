package td2;

/**
 *
 * @author freax
 */
public class ex3 {
  public static void main(String[] args) {
    ListeDeRectangles list = new ListeDeRectangles();
    Rectangle r1 = new Rectangle(0, 0, 1, 1);
    Rectangle r2 = new Rectangle(0, 0, 2, 2);
    Rectangle r3 = new Rectangle(0, 0, 3, 3);
    Rectangle r4 = new Rectangle(0, 0, 4, 4);
    Rectangle r5 = new Rectangle(0, 0, 5, 5);
    Rectangle r6 = new Rectangle(0, 0, 6, 6);

    System.out.println("Liste vide : \n" + list);

    list.inserer(r1);
    list.inserer(r2);
    list.inserer(r3);
    System.out.println("Après ajout de 3 valeurs \n" + list);

    System.out.println("Affichage des surfaces : ");
    list.toutesLesSurfaces();
  }
}
