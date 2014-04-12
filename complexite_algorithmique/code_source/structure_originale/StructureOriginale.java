package structure_originale;

import java.util.HashMap;

import corpus.CorpusInterface;

/**
 * @author Omar
 */
public class StructureOriginale implements CorpusInterface {
	private HashMap<Character, StructureOriginale> table;// index
	protected int occurence;

	public StructureOriginale() {
		occurence = 0;
		table = null;
		table = new HashMap<Character, StructureOriginale>();
	}

	public void ajouter(String mot) {
		if (mot.length() > 0) {
			// on récupère la première lettre du mot
			char c = mot.charAt(0);
			// on supprime la première lettre du mot
			mot = mot.substring(1);
			// on récupère le noeud dans la table correspondant à la première
			// lettre du mot
			StructureOriginale n = table.get(c);
			// si le noeud n'existe pas, on le crée et on l'ajoute à la table
			if (n == null) {
				n = new StructureOriginale();
				table.put(c, n);
			}
			// on effectue un appel récursif sur le noeud fils avec le mot
			// (dépourvu de sa première lettre)
			n.ajouter(mot);
		} else {
			// le mot n'a plus de lettre : on se situe dans le bon noeud :
			// on incrémente donc le nombre d'occurrence du nœud courant
			occurence++;
		}
	}

	public boolean existe(String mot) {
		if (occurrences(mot) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public int occurrences(String mot) {
		if (mot.length() > 0) {
			// on récupère la première lettre du mot
			char c = mot.charAt(0);
			// on supprime la première lettre du mot
			mot = mot.substring(1);
			// on récupère le noeud dans la table correspondant à la première
			// lettre du mot
			StructureOriginale n = table.get(c);

			if (n == null) {
				// si le noeud n'existe pas, il n'y a pas d'occurence du mot
				return 0;
			} else {
				// sinon, on effectue un appel récursif sur le noeud fils avec le
				// mot (dépourvu de sa première lettre)
				return n.occurrences(mot);
			}
		} else {
			// le mot n'a plus de lettre : on se situe dans le bon noeud :
			// on retourne le nombre d'occurence du noeud courant
			return occurence;
		}
	}
}
