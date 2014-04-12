import calculateur.*;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.IOException;
import java.util.Collections;
import java.util.HashMap;
import java.util.ArrayList;
import java.util.List;
import java.util.Map.Entry;

/**
 * Initialise et lance l'exécution de machines de Turing avec des mots utilisateurs
 */
public class LanceurTuring {
  private HashMap<String, Calculateur> machines;  // Tableau associatif nom de machine => machine
  private Calculateur machineCourante;            // Machine utilisée actuellement par le programme
  
  /**
   * Constructor
   */
  private LanceurTuring() {
    this.machines = new HashMap<String, Calculateur>();
    this.machineCourante = null;
    
    // Ajoute toutes les machines
    this.machines.put("Un_E_Zero", new Un_E_Zero());
    this.machines.put("Decaleur", new Decaleur());
    this.machines.put("DivisionBinairePar2", new DivisionBinairePar2());
    this.machines.put("AdditionBinaire", new AdditionBinaire());
    this.machines.put("MultiplicationBinaire", new MultiplicationBinaire());
  }
  
  /**
   * Affiche l'utilisation du lanceur
   */
  public void usage() {
    System.out.println("Lanceur de machine de Turing.");
    System.out.println("Utilisation: <commande> param1 param2 param3\n");
    System.out.println("Commandes:");
    System.out.println("- ls: Liste toutes les machines disponibles");
    System.out.println("- use <Machine>: Sélectionne une machine pour utilisation");
    System.out.println("- run <symbole_1> <symbole_2> <symbole_n>: exécute une commande sur la machine avec les symboles de l'alphabet");
    System.out.println("- help : Aide et cas d'utilisation de la machine");
    System.out.println("- config: configuration de la machine");
    System.out.println("- timing <0,1>: Enclenche la gestion du temps d'éxecution (0 ou 1)");
    System.out.println("- usage : affiche le guide d'utilisation du lanceur");
    System.out.println("- exit : quitte l'application");
  }
  
  /**
   * Liste toutes les machines
   */
  public void ls() {
    System.out.println("Liste des machines: ");
    for (Entry<String, Calculateur> entree : this.machines.entrySet()) {
      System.out.println("- "+entree.getKey());
    }
  }
  
  /**
   * Change la machine courante
   * 
   * @param nom nom de la machine à utiliser
   */
  public void use(String nom) {
    for (Entry<String, Calculateur> entree : this.machines.entrySet()) {
      if (entree.getKey().equals(nom)) {
        this.machineCourante = entree.getValue();
        return ;
      }
    }
    
    // Si aucune machine n'est trouvée
    System.out.println("La machine n'a pas été trouvée\n");
    this.ls();
  }
  
  /**
   * Affiche l'aide de la machine
   */
  public void help() {
    if (this.machineCourante == null) {
      System.out.println("Aucune machine n'a été selectionnée\n");
      this.ls();
      return;
    }
    
    System.out.println(this.machineCourante.help());
  }
  
  /**
   * Affiche la configuration de la machine
   */
  public void config() {
    if (this.machineCourante == null) {
      System.out.println("Aucune machine n'a été selectionnée\n");
      this.ls();
      return;
    }
    
    this.machineCourante.affiche();
  }
  
  /**
   * Lance l'exécution de la machine
   * 
   * @param mot mot à utiliser
   */
  public void run(String mot) {
    if (this.machineCourante == null) {
      System.out.println("Aucune machine n'a été selectionnée\n");
      this.ls();
      return;
    }
    
    this.machineCourante.reset();
    this.machineCourante.setMot(mot);
    this.machineCourante.execute();
    
    if (this.machineCourante.getResultat()) {
      System.out.println("OK");
    } else {
      System.out.println("FAIL");
    }
  }
  
  /**
   * Affiche ou non le timing de la machine
   */
  public void timing(int on) {
    boolean yes = (on != 0) ? true : false;
    
    // Changement pour toutes les machines
    for (Entry<String, Calculateur> entree : this.machines.entrySet()) {
      entree.getValue().setTiming(yes);
    }
  }
  /**
   * Accomplit une instruction
   * 
   * @param instructions Tableau contenant la commande et une suite de paramètres
   */
  public void faire(ArrayList<String> instructions) {
    if (instructions.isEmpty()) // Plus rapide
      return;
            
    String action = instructions.get(0);
    
    // Dispatcher
    if (action.equals("ls")) {
      this.ls();
    } else if (action.equals("use") && instructions.size() == 2) {
      this.use(instructions.get(1));
    } else if (action.equals("run") && instructions.size() > 1) {
      // Reconstruit un mot à partir des suites de symboles
      List<String> symboles = instructions.subList(1, instructions.size());
      StringBuilder mot = new StringBuilder();
      
      for (String s : symboles) {
        mot.append(s).append(" ");
      }
      
      this.run(mot.toString().trim());
    } else if (action.equals("help")) {
      this.help();
    } else if (action.equals("config")) {
      this.config();
    } else if (action.equals("timing") && instructions.size() == 2) {
      this.timing(Integer.valueOf(instructions.get(1)));
    } else if (action.equals("usage")) {
      this.usage();
    } else if (action.equals("exit")) {
      System.out.println("Bye bye ...");
      System.exit(0);
    } else {
      System.out.println("Cette commande n'existe pas");
    }
  }
  
  /**
   * Écoute les instructions de l'utilisateur et exécute ses ordres
   */
  public void ecoute() {
    InputStreamReader in = new InputStreamReader(System.in);
    BufferedReader reader = new BufferedReader(in);
    
    // Boucle infinie d'écoute. Seul la commande "exit" peut quitter l'application
    while (true) {
      try {
        System.out.print(">> ");
        String commande = reader.readLine();
        ArrayList<String> instructions = new ArrayList<String>();
        Collections.addAll(instructions, commande.split(" "));
        
        this.faire(instructions);
      } catch (IOException err) {
        System.out.println(err);
        System.exit(1);
      }
    }
  }
  
  /**
   * @param args the command line arguments
   */
  public static void main(String[] args) {
    // Lance le lanceur !
    LanceurTuring lanceur = new LanceurTuring();
    lanceur.usage();
    lanceur.ecoute();
  }
}
