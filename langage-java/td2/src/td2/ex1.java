package td2;

/**
 *
 * @author freax
 */
public class ex1 {
  public static void main(String[] args) {
    Point p1 = new Point(2, 2);
    Point p2 = new Point(4, 6);
    Rectangle r = new Rectangle(p1, p2);

    System.out.println("Rectangle initial : " + r);

    System.out.println("Surface du rectangle : " + r.surface());

    p1.deplacer(2, 3);
    System.out.println("Rectangle après translation de p1 (2,3) : " + r);

    System.out.println("Surface du rectangle : " + r.surface());
  }
}
