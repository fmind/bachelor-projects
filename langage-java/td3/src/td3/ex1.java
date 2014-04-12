package td3;

/**
 *
 * @author freax
 */
public class ex1 {

  public static double somme_harmonique(int n) {
    double somme = 0;
    
    for (int i=1; i<=n; i++) {
      somme += 1.0/i;
    }

    return somme;
  }

  public static int plus_petit_entier(double l) {
    int i = 1;

    while(true) {
      if (somme_harmonique(i) >= l) return i;
      i++;
    }
  }

  public static void entiers_egaux_somme_cubes_chiffres(int n) {
    for (int i=0; i<=n; i++) {
      int x = i;
      int somme = 0;

      while (x != 0) {
        somme += Math.pow(x%10, 3);
        x = x / 10;
      }

      if (somme == i) {
        System.out.println(i);
      }
    }
  }

  public static void entiers_parfaits(int n) {
    for (int i=2; i<=n; i++) {
      int somme = 0;

      for (int j=1; j<i; j++) {
        if (i%j == 0) {
          somme += j;
        }
      }

      if (somme == i) {
        System.out.println(i);
      }
    }
  }

  public static int matrice_non_occurence(int[][] matrice, int x) {
    int occ = 0;

    for (int i=0; i<matrice.length; i++) {
      for (int j=0; j<matrice[i].length; j++) {
      if (matrice[i][j] != x) occ++;
      }
    }

    return occ;
  }

  public static String date_mois(String date) {
    String[] MOIS = {"Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"};
    String parties[] = date.split("/");
    int mois = Integer.parseInt(parties[1]);

    return MOIS[mois-1];
  }

  public static void main(String[] args) {
    System.out.println("Somme harmonique n=2 : " + somme_harmonique(2));
    System.out.println("Somme harmonique n=6 : " + somme_harmonique(6));
    
    System.out.println("Plus petit entier pour l=2 : " + plus_petit_entier(2));
    System.out.println("Plus petit entier pour l=6 : " + plus_petit_entier(6));

    System.out.println("Entiers égaux à la somme des chiffres les composants : ");
    entiers_egaux_somme_cubes_chiffres(500);

    System.out.println("Entiers parfaits : ");
    entiers_parfaits(1000);

    int[][] matrice = new int[3][3];
    matrice[0][0] = 1664;
    matrice[0][1] = 1;
    matrice[0][2] = 2;
    matrice[1][0] = 3;
    matrice[1][1] = 1664;
    matrice[1][2] = 4;
    matrice[2][0] = 5;
    matrice[2][1] = 6;
    matrice[2][2] = 1664;
    
    System.out.println("Nombre dans la matrice différent de 1664 : " + matrice_non_occurence(matrice, 1664));

    System.out.println("Mois de la date 25/11/1988 : " + date_mois("25/11/1988"));
    System.out.println("Mois de la date 03/04/2005 : " + date_mois("03/04/2005"));
  }
}
