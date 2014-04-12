package avl;

import arbre.ArbreInterface;

/**
 * Structure AVL
 * 
 * @author Florent
 */
public class AVL implements ArbreInterface {
	private short deseq, h; // Déséquilibre des sous arbres et hauteur du noeud
	private String val; // Valeur stockée dans le noeud
	private int occurrences = 0; // Nombre d'occurrences de la valeur
	private boolean vide; // Indique si le noeud est une feuille
	private AVL fg, fd; // Fils gauche et fils droit du noeud

	public AVL() {
		this.vide = true;
		this.fg = this.fd = null;
		this.deseq = 0;
		this.h = 0;
	}

	private AVL(String v, int oc, AVL g, AVL d) {
		this.val = v;
		this.occurrences = oc;
		this.fg = g;
		this.fd = d;
		this.deseq = (short) (g.h - d.h);
		this.h = (short) (1 + Math.max(g.h, d.h));
	}

	private void rotationG() {
		if (fd.vide) {
			System.out.println("Erreur - Rotation Droite");
			return;
		}
		fg = new AVL(val, occurrences, fg, fd.fg);
		val = fd.val;
		occurrences = fd.occurrences;
		fd = fd.fd;
		h = (short) (1 + Math.max(fg.h, fd.h));
		deseq = (short) (fg.h - fd.h);
	}

	private void rotationD() {
		if (fg.vide) {
			System.out.println("Erreur - Rotation Gauche");
			return;
		}
		fd = new AVL(val, occurrences, fg.fd, fd);
		val = fg.val;
		occurrences = fg.occurrences;
		fg = fg.fg;
		h = (short) (1 + Math.max(fg.h, fd.h));
		deseq = (short) (fg.h - fd.h);
	}

	private void rotationGD() {
		if (fg.vide) {
			System.out.println("Erreur - Rotation Gauche-Droite 1");
			return;
		}
		if (fg.fd.vide) {
			System.out.println("Erreur - Rotation Gauche-Droite 2");
			return;
		}
		fg.rotationG();
		rotationD();
	}

	private void rotationDG() {
		if (fd.vide) {
			System.out.println("Erreur - Rotation Droite-Gauche 1");
			return;
		}
		if (fd.fg.vide) {
			System.out.println("Erreur - Rotation Droite-Gauche 2");
			return;
		}
		fd.rotationD();
		rotationG();
	}

	/**
	 * Transforme un noeud en une feuille
	 * 
	 * @param v
	 *           Valeur du noeud
	 */
	private void feuille(String v) {
		val = v;
		vide = false;
		occurrences = 1;
		fg = new AVL();
		fd = new AVL();
		deseq = 0;
		h = 1;
	}

	public void ajouter(String v) {
		AVL pos = this;
		AVL prec = null; // reference sur le dernier noeud avec un deseq =/= 0
		while (!pos.vide) {
			if (pos.deseq != 0)
				prec = pos;
			switch (cmpStr(v, pos.val)) {
			case -1:
				pos = pos.fg;
				break;
			case 1:
				pos = pos.fd;
				break;
			default:
				pos.occurrences++;
				// le mot est déjà dans l'arbre, on incrémente le compteur et on
				// sort
				return;
			}
		}
		pos.feuille(v); // on ajoute x...
		AVL posx = pos; // on garde la position de x

		if (prec == null)
			prec = this; // tous les ancêtres de x ont un deseq nul, on va faire la
							 // mise à jour du deseq depuis la racine...

		pos = prec;
		while (pos != posx) { // on fait la M-A-J des deseq depuis prec... jusqu'a
									 // la feuille de x
			switch (cmpStr(v, pos.val)) {
			case 1:
				pos.deseq--;
				if (pos.deseq < 0)
					pos.h++; // test nécessaire si prec.deseq valait +1 avant l'ajout
				pos = pos.fd;
				break;
			default:// ajout à gauche --> 1
				pos.deseq++;
				if (pos.deseq > 0)
					pos.h++; // test nécessaire si prec.deseq valait -1 avant l'ajout
				pos = pos.fg;
				break;
			}
		}

		// on rééquilibre si nécessaire
		switch (prec.deseq) {
		case -2:
			switch (cmpStr(v, prec.fd.val)) {// ajout à droite, donc prec.fd existe
			case 1:
				prec.rotationG();
				break;
			default:
				prec.rotationDG();
				break;
			}
			break;
		case -1:
		case 0:
		case 1:
			break;
		case 2:
			switch (cmpStr(v, prec.fg.val)) {// ajout à gauche, donc prec.fg existe
			case 1:
				prec.rotationGD();
				break;
			default:
				prec.rotationD();
				break;
			}
			break;
		default:
			System.out.println("Erreur - valeur de déséquilibre impossible");
		}
	}

	public int occurrences(String mot) {
		if (vide)
			return 0;
		else
			switch (cmpStr(mot, this.val)) {
			case -1:
				return this.fg.occurrences(mot);
			case 1:
				return this.fd.occurrences(mot);
			default:
				return this.occurrences;
			}
	}

	public boolean existe(String mot) {
		if (vide) {
			return false;
		} else
			switch (cmpStr(mot, this.val)) {
			case -1:
				return this.fg.existe(mot);
			case 1:
				return this.fd.existe(mot);
			default:
				return true;
			}
	}

	public int hauteur(int hauteur_depart) {
		hauteur_depart++;
		if (this.fg == null || this.fd == null)
			return hauteur_depart;
		return Math.max(this.fg.hauteur(hauteur_depart), this.fd.hauteur(hauteur_depart));
	}

	/**
	 * Compare deux chaînes de caractère. Retourne -1 si a < b, 0 si a == b, 1 si
	 * a > b
	 * 
	 * @param a
	 *           Première chaîne
	 * @param b
	 *           Deuxième chaîne
	 * @return entier -1, 0 ou 1
	 */
	public static int cmpStr(String a, String b) {
		if (a == null)
			return -1;
		if (b == null)
			return 1;
		int la = a.length();
		int lb = b.length();
		int min = Math.min(la, lb);

		for (int i = 0; i < min; i++)
			if (a.charAt(i) < b.charAt(i))
				return -1;
			else if (a.charAt(i) > b.charAt(i))
				return 1;
		if (la > min)
			return 1;
		else if (lb > min)
			return -1;
		else
			return 0;
	}

	public void afficher() {
		if (!vide) {
			fg.afficher();
			System.out.print(this + " ");
			fd.afficher();
		}
	}

	public String toString() {
		return "\'" + this.val + "\'x" + this.occurrences + " (" + this.deseq + ") ";
	}
}
