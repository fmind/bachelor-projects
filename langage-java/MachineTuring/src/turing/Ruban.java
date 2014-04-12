package turing;

import java.util.ArrayList;
import java.util.Collections;

/**
 * Périphérique d'entrée d'une machine de Turing
 */
public class Ruban {
  private ArrayList<String> symboles;
  private int position;

  /**
   * Constructor
   */
  public Ruban() {
    this.symboles = new ArrayList<String>();
    this.position = 0;
  }
  
  /**
   * Remplit le ruban avec un mot
   * 
   * @note un symbole peut être composé de plusieurs caractères
   * @param mot chaîne de caractère. Chaque symbole est séparé par un espace
   */
  public void setMot(String mot) {
    this.position = 0;
    this.symboles = new ArrayList<String>();
    Collections.addAll(this.symboles, mot.split(" "));
  }
  
  /**
   * Avance sur le ruban
   */
  public void avancer() {
    this.position++;
  }
  
  /**
   * Recule sur le ruban
   */
  public void reculer(){
     this.position--;
  }
  
  /**
   * Lit le symbole à la position courante
   * 
   * @note renvoie le symbole bottom en début et fin de ruban
   * @return le symbole lu ou "$" (symbole bottom)
   */
  public String lecture() {
    // Cas particulier: début ou fin de ruban
    if (this.position < 0 || this.position >= this.symboles.size())
      return "$";
    
    return this.symboles.get(this.position);
  }
  
  /**
   * Écrit le symbole à la position courante
   * 
   * @note peut rajouter un élément au début ou à la fin du ruban
   * @param symbole le symbole à écrire
   */
  public void ecrire(String symbole) {
    // Cas particulier: symbole de fin identique
    if (symbole.equals("$") && this.lecture().equals("$")) {
      return;
    }
    
    // Cas particulier: symbole vide
    if (symbole.isEmpty()) {
      if (this.position >= 0 && this.position < this.symboles.size()) {
        this.symboles.remove(this.position);
        this.position--;
        return;
      }
    }
    
    // Ajout d'un nouvel élément au début du ruban
    if (this.position < 0) {
      this.symboles.add(0, symbole);
      this.position = 0;
    // Ajout d'un nouvel élément à la fin du ruban
    } else if (this.position >= this.symboles.size()) { 
      this.symboles.add(symbole);
    // Remplacement d'un symbole
    } else {
      this.symboles.set(this.position, symbole);
    }
  }
  
  @Override
  public String toString() {
    StringBuilder str = new StringBuilder(); 
    str.append("R: ");
    
    for (int i = 0; i < this.symboles.size(); i++) {
      if (i == this.position) {
        str.append("_").append(this.symboles.get(i)).append("_|");
      } else {
        str.append(this.symboles.get(i)).append("|");
      }
    }
    
    if (this.position == this.symboles.size()) {
      str.append("_$_");
    } else {
      str.append("$");
    }
    
    
    return str.toString();
  }
}
