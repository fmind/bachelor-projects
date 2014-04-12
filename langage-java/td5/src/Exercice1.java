class A {
  public A() {
    System.out.println("A");
  }
}

class B extends A {
  public B() {
    System.out.println("B");
  }
}

class C extends B {
  public C() {
    System.out.println("C");
  }
}

/**
 *
 * @author mederic
 */
public class Exercice1 {
  public static void main(String[] args) {
    // L'appel au constructeur super est implicite.
    // Il est appelé au début du constructeur de la classe fille
    C c = new C();
  }
}