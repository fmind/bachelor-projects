package td1;

/**
 *
 * @author freax
 */
public class ex2 {
  public static void main(String[] args) {
    args = new String[3];
    args[0] = "4";
    args[1] = "6";
    args[2] = "10";

    int somme = 0;

    for (String arg : args) {
      somme += Integer.parseInt(arg);
    }

    System.out.println("Somme : "+somme);
  }
}
