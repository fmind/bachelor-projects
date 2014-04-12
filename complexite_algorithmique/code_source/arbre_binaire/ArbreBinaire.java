package arbre_binaire;

import arbre.ArbreInterface;

/**
 * Algorithme des arbres binaires. Cette classe se sert de la fonction de
 * comparaison décrite dans la classe AVL
 * 
 * @author Florent
 * @author Quentin
 */
public class ArbreBinaire implements ArbreInterface {
	private ArbreBinaire fg, fd;
	private String val;
	private int occurrences;

	public ArbreBinaire() {
		this(null, null, null);
		this.occurrences = 0;
	}

	public ArbreBinaire(String v) {
		this(v, null, null);
	}

	public ArbreBinaire(String v, ArbreBinaire g, ArbreBinaire d) {
		this.fg = g;
		this.fd = g;
		this.val = v;
		this.occurrences = 1;
	}

	public void afficher() {
		if (this.fg != null)
			fg.afficher();
		System.out.print(this + " ");
		if (this.fd != null)
			fd.afficher();
	}

	public String toString() {
		return "\'" + this.val + "\'x" + this.occurrences;
	}

	public void ajouter(String mot) {
		if (this.val == null) {
			this.val = mot;
			this.occurrences++;
			return;
		}
		switch (avl.AVL.cmpStr(mot, this.val)) {
		case -1:
			if (this.fg == null)
				this.fg = new ArbreBinaire(mot);
			else
				this.fg.ajouter(mot);
			break;
		case 1:
			if (this.fd == null)
				this.fd = new ArbreBinaire(mot);
			else
				this.fd.ajouter(mot);
			break;
		default:
			this.occurrences++;
			break;
		}
	}

	public boolean existe(String mot) {
		return this.occurrences(mot) != -1;
	}

	public int occurrences(String mot) {
		int difference = avl.AVL.cmpStr(this.val, mot);
		if (difference > 0)
			if (this.fg != null)
				return this.fg.occurrences(mot);
			else
				return -1;
		else if (difference < 0)
			if (this.fd != null)
				return this.fd.occurrences(mot);
			else
				return -1;
		else
			return this.occurrences;
	}

	public int hauteur(int hauteur_depart) {
		hauteur_depart++;
		if (this.fg == null || this.fd == null)
			return hauteur_depart;
		return Math.max(this.fg.hauteur(hauteur_depart), this.fd.hauteur(hauteur_depart));
	}
}
