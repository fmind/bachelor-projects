package td2;

/**
 *
 * @author freax
 */
public class Point {

  public int x;
  public int y;

  public Point(int x, int y) {
    this.x = x;
    this.y = y;
  }

  public Point copie() {
    return new Point(this.x, this.y);
  }

  public int compareTo(Point p) {
    if (this.x > p.x) {
      return -1;
    } else if (this.x < p.x) {
      return 1;
    } else {
      return 0;
    }
  }

  public void deplacer(int a, int b) {
    this.x += a;
    this.y += b;
  }

  @Override
  public String toString() {
    return "x:" + this.x + ",y:" + this.y;
  }
}
