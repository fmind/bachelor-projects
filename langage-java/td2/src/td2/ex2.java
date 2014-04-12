package td2;

/**
 *
 * @author freax
 */
public class ex2 {
  public static void main(String[] args) {
    TableauDeRectangles tab = new TableauDeRectangles();
    Rectangle r1 = new Rectangle(0, 0, 1, 1);
    Rectangle r2 = new Rectangle(0, 0, 2, 2);
    Rectangle r3 = new Rectangle(0, 0, 3, 3);
    Rectangle r4 = new Rectangle(0, 0, 4, 4);
    Rectangle r5 = new Rectangle(0, 0, 5, 5);
    Rectangle r6 = new Rectangle(0, 0, 6, 6);
    Rectangle r7 = new Rectangle(0, 0, 7, 7);
    Rectangle r8 = new Rectangle(0, 0, 8, 8);
    Rectangle r9 = new Rectangle(0, 0, 9, 9);
    Rectangle r10 = new Rectangle(1, 1, 10, 10);

    System.out.println("Tableau vide : \n" + tab);

    tab.inserer(0, r1);
    tab.inserer(0, r2);
    tab.inserer(0, r3);
    System.out.println("Après ajout de 3 valeurs (insertion)\n" + tab);

    tab.inserer(1, r4);
    System.out.println("Ajout d'un rectangle à la position 1 : \n" + tab);

    tab.inserer(8, r5);
    System.out.println("Ajout d'un rectangle à la position 8 : \n" + tab);

    if (tab.rechercher(r1)) {
      System.out.println("Le rectangle "+r1+" existe dans le tableau");
    } else {
      System.out.println("Le rectangle "+r1+" n'existe pas dans le tableau");
    }

    if (tab.rechercher(r10)) {
      System.out.println("Le rectangle "+r10+" existe dans le tableau");
    } else {
      System.out.println("Le rectangle "+r10+" n'existe pas dans le tableau");
    }

    System.out.println("Affichage des surfaces : ");
    tab.ToutesLesSurfaces();
  }
}
