package td3;

/**
 *
 * @author freax
 */
public class ex2 {
  public static String toto;
  public int tata;
  
  public static void entiers_positifs_desc(int n) {
    System.out.println(n);
    if (n > 1)
      entiers_positifs_desc(n-1);
  }

  public static void entiers_positifs_asc(int n) {
    if (n >= 1)
      entiers_positifs_asc(n-1);
    System.out.println(n);
  }

  public static int factorielle(int n) {
    if (n == 1)
      return 1;
    else
      return n * factorielle(n-1);
  }

  public static int fibonacci(int n) {
    if (n <= 1)
      return n;
    else
      return fibonacci(n-1) + fibonacci(n-2);
  }
  
  public static void main(String[] args) {
    System.out.println("Entier décroissant jusqu'à 9 : ");
    entiers_positifs_desc(9);

    System.out.println("Entier croissant jusqu'à 9 : ");
    entiers_positifs_asc(9);

    System.out.println("Factorielle 3 : " + factorielle(3));
    System.out.println("Factorielle 6 : " + factorielle(6));

    System.out.println("Fibonacci 3 : " + fibonacci(3));
    System.out.println("Fibonacci 6 : " + fibonacci(6));
  }
}
