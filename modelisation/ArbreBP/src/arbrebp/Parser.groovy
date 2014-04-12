package arbrebp

/**
 * Classe utilitaire permettant d'analyser les requêtes utilisateurs
 *
 * @author Médéric Hurier
 */
class Parser {
  static int ordre = 3
  static String chemin = '.'
  static String cle = 'nom'

  // Index
  static ArbreBP arbre_age = null
  static ArbreBP arbre_nom = null
  static ArbreBP arbre     = null   // Arbre utilisé
  static boolean entier    = false  // L'index est de type entier

  /**
   * Génère les arbres à partir des arguments fournis en ligne de commande
   */
  private static def configure(String[] args) {
    CliBuilder cli = new CliBuilder(usage: "java -jar ArbreBP.jar")
    cli.n(argName: "ordre", args:1 , required: false, "Ordre de l'arbre (défaut: ${Parser.ordre})")
    cli.p(argName: "chemin", args:1 , required: true, "Chemin où se trouve les fichiers")
    
    def options = cli.parse(args)

    // Analyse les options
    if (!options)  { System.exit(1) }
    if (options.n) { Parser.ordre = options.n.toInteger() }
    if (options.p) { Parser.chemin = options.p }

    // Récapitulatif des paramètres
    println ""
    println "Ordre : ${Parser.ordre}"
    println "Chemin : ${Parser.chemin}"
    println ""

    // Créer les arbres
    Parser.arbre_age = new ArbreBP(Parser.ordre)
    Parser.arbre_nom = new ArbreBP(Parser.ordre)
  }

  /**
   * Rempli les arbres à partir des fichiers
   */
  private static def populate() {
    // Analyse tous les fichiers du chemin
    new File(Parser.chemin).eachFile { file ->
      // Chaque colonne du fichier (séparée par un ':')
      file.text.splitEachLine(':') { colonnes ->
        String cle = colonnes[0].trim().toLowerCase()

        // Ajoute dans le bon arbre selon la clé
        if (cle == 'age') {
          Parser.arbre_age.ajout(colonnes[1].toInteger(), file)
        } else if (cle == 'nom') {
          Parser.arbre_nom.ajout(colonnes[1], file)
        }
      }
    }
  }

  /**
   * Affiche le fonctionnement du prompteur
   */
  private static def fonctionnement() {
    println "Conventions : "
    println "- Valeurs strictement inférieurs à la valeur du noeud interne à GAUCHE"
    println "- Utilisez la commande 'use' d'éxecuter des fonctions sur l'arbre"
    println ""
    println "Commandes : "
    println "- help : Affiche cette aide"
    println "- index : liste les index"
    println "- use x : Choisi l'arbre x (Ex: use age)"
    println "- affiche : Affiche l'arbre"
    println "- recherche x : Recherche la valeur pour x"
    println "- supprime x : Supprime la valeur x"
    println "- test_ajout : Lance un test d'ajout/recherche indépendant [Médéric Hurier]"
    println "- test_suppression : Lance un test de suppression indépendant [Maxime Bruant]"
    println "- exit : Quitter le programme"
  }

  /**
   * Execute une commande
   *
   * @param line ligne de commande
   */
  private static def execute(String line) {
    String command = ""
    String[] args = []
    def params = line.split()

    // Sépare la commande des paramètres
    command = params[0]
    if (params.size() > 1) args = params[1..-1]

    if (command == 'help') {
      /*
       * Affiche l'aide
       */
      Parser.fonctionnement()
    } else if (command == 'index') {
      /*
       * Liste les index
       */
      println "Index: "
      println "- nom"
      println "- age"
    } else if (command == 'use' && args.size() == 1) {
      /*
       * Choisi un arbre
       */
      if (args[0] == 'age') {
        arbre = arbre_age
        Parser.entier = true
        println "Choix de l'arbre : arbre_${args[0]} (type entier)"
      }
      else if (args[0] == 'nom') {
        arbre = arbre_nom
        Parser.entier = false
        println "Choix de l'arbre : arbre_${args[0]} (type chaîne de caractère)"
      } else {
        println "L'arbre ${args[0]} n'existe pas"
      }
    } else if (command == 'recherche' && args.size() == 1) {
      /*
       * Effectue une recherche sur une valeur
       */
      if (!arbre) {
        println "Vous devez sélectionner un arbre. Exemple :"
        println "use age"
      } else {

        println "Recherche ${args[0]} => ${Parser.arbre.recherche((Parser.entier) ? args[0].toInteger() : args[0])}"
      }
    } else if (command == 'supprime' && args.size() == 1) {
      /*
       * Supprime une valeur
       */
      if (!arbre) {
        println "Vous devez sélectionner un arbre. Exemple :"
        println "use age"
      } else {
        Parser.arbre.suppression(args[0])
        println "Suppression effectuée"
      }
    } else if (command == 'affiche') {
      /*
       * Affiche l'arbre
       */
      if (!arbre) {
        println "Vous devez sélectionner un arbre. Exemple :"
        println "use age"
      } else {
        Parser.arbre.afficher()
      }
    } else if (command == 'test_ajout') {
      /*
       * Lance un test d'ajout
       */
      ArbreBPAjoutTest.go()
    } else if (command == 'test_suppression') {
      /*
       * Lance un test d'ajout
       */
      ArbreBPSuppressionTest.go()
    } else if (command != 'exit') {
      /*
       * Cas d'une commande non reconnue
       */
      println "Commande non reconnue"
      println "Tapez 'help' pour afficher l'aide"
    }
    
    return (command == 'exit') ? false : true
  }

  /**
   * Requêteur en ligne de commande
   * continue tant que l'utilisateur ne tape pas 'exit'
   */
  private static def prompter() {
    System.in.withReader {
      print  '\narbrebp# '

      // Continue tant que l'on execute une ligne
      while (Parser.execute(it.readLine())) {
        println ''
        print  'arbrebp# '
      }
    }

    // La politesse :)
    println "\nBye bye\n"
  }

  /**
   * Initialise l'analyseur de requête
   */
  static def init(String[] args) {
    Parser.configure(args)
    Parser.populate()
    Parser.execute('help')
    Parser.prompter()
  }
}
