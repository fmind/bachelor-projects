package td1;

/**
 *
 * @author freax
 */
public class ex4 {
  public static void main(String[] args) {
    Rectangle rect = new Rectangle(new Point(5, 10), new Point(10, 20));
    System.out.println("Surface du rectangle : " + rect);
    System.out.println(rect.surface());
  }
  
}
