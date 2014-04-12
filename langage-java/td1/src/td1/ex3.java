/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package td1;

/**
 *
 * @author freax
 */
public class ex3 {
  public static void main(String[] args) {
    Producteur prod_kro = new Producteur("Producteur Kro", "Luxembourg");
    Producteur prod_lee = new Producteur("Producteur Lee", "Belge");
    
    Biere kro = new Biere("Kronenbourg", 4.2, prod_kro);
    kro.goutBiere = "mauvais";
    Biere lee = new Biere("Lee", 5, prod_lee);
    lee.goutBiere = "Très mauvais"; // Change le gout de toutes les bières !

    System.out.println("Bieres initiales");
    System.out.println(kro);
    System.out.println(lee);

    System.out.println("\nAprès OPA de Kronenbourg sur Lee");
    kro.opa(lee);
    System.out.println(kro);
    System.out.println(lee);

    System.out.println("\nChangement producteur de Kronenbourg");
    prod_kro.nom = "Nouveau producteur";
    System.out.println(kro);
    System.out.println(lee);
    // Le producteur de kro ET de lee change

    System.out.println("\nChangement de degrés");
    kro.degres = 10;
    System.out.println(kro);
    System.out.println(lee);
  }
}
