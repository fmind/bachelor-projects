package table_hachage;

import corpus.CorpusInterface;
import java.util.Vector;

/**
 * @author Mathieu
 */
public class TableDeHachage implements CorpusInterface {

	private Vector<Enregistrement> valeurs;
	private boolean java;

	public TableDeHachage() {
		java = true;
		valeurs = new Vector<Enregistrement>();
	}

	public TableDeHachage(boolean j) {
		java = j;
		valeurs = new Vector<Enregistrement>();
	}

	public void ajouter(String mot) {
		int indice = hachage(mot, this.java);

		if (valeurs.size() <= indice) {
			valeurs.setSize(indice + 1);
		}
		if (valeurs.get(indice) == null) {

			valeurs.set(indice, new Enregistrement(mot));
		} else {
			// Sinon collision
			// Il faut rechercher dans la liste chaînée si le mot existe déjà
			Enregistrement premier = valeurs.get(indice), courant = valeurs.get(indice);
			courant = rechercherListeChainee(premier, mot);
			boolean existe = courant != null;
			if (existe) {
				// Si le mot est déjà enregistre on incrémente son occurrence
				incrementerOccurence(courant);
			} else {
				// Sinon on l'ajoute dans la liste chaînée
				ajouterListeChainee(premier, new Enregistrement(mot));
			}
		}
	}

	public void ajouterListeChainee(Enregistrement premier, Enregistrement suivant) {
		suivant.setSuivant(premier.getSuivant());
		premier.setSuivant(suivant);
	}

	Enregistrement rechercherListeChainee(Enregistrement courant, String mot) {
		boolean trouve = false;
		trouve = courant.getMot().equals(mot);
		while (courant.getSuivant() != null && !trouve) {
			courant = courant.getSuivant();
			if (courant.getMot().equals(mot)) {
				// Si le mot est le mme on retourne l'enregistrement
				trouve = true;
			}
		}
		// On retourne null si le mot n'est pas reference
		return trouve ? courant : null;
	}

	public void incrementerOccurence(Enregistrement e) {
		int occurence = e.getOccurence();
		occurence++;
		e.setOccurence(occurence);
	}

	public int occurrences(String mot) {
		int occurences;
		int indice;

		if (!existe(mot)) {
			// Si le mot n'existe pas il n'y a aucune occurrence
			occurences = 0;
		} else {
			indice = hachage(mot, this.java);
			occurences = rechercherListeChainee(valeurs.get(indice), mot).getOccurence();
		}
		return occurences;
	}

	public boolean existe(String mot) {
		int indice = hachage(mot, this.java);
		boolean existe;

		if (valeurs.size() <= indice || valeurs.get(indice) == null) {
			// S'il n'y a pas d'enregistrement a cet indice le mot n'est pas
			// référenceŽ
			existe = false;
		} else {
			// S'il y a un enregistrement on recherche le mot dans la liste chaînée
			existe = rechercherListeChainee(valeurs.get(indice), mot) != null;
		}

		return existe;
	}

	public static int hachage(String mot, boolean java) {
		if (java)
			return (Math.abs(mot.hashCode()) / 1000);
		else
			return (TableDeHachage.hachagePerso(mot) / 1000);
	}

	public static int hachagePerso(String mot) {
		if (mot.length() < 1)
			return 0;
		else
			return (int) ((mot.charAt(0) * mot.charAt(mot.length() / 3) * mot.length()) * 7.3);
	}

	public Vector<Enregistrement> getValeurs() {
		return valeurs;
	}

	public class Enregistrement {
		private String mot;
		private int occurence;
		private Enregistrement suivant;

		public Enregistrement() {
			super();
		}

		public Enregistrement(String mot) {
			super();
			this.mot = mot;
			this.occurence = 1;
		}

		public Enregistrement(String mot, int occurence) {
			super();
			this.mot = mot;
			this.occurence = occurence;
		}

		public Enregistrement(String mot, int occurence, Enregistrement suivant) {
			super();
			this.mot = mot;
			this.occurence = occurence;
			this.suivant = suivant;
		}

		public String getMot() {
			return mot;
		}

		public void setMot(String mot) {
			this.mot = mot;
		}

		public int getOccurence() {
			return occurence;
		}

		public void setOccurence(int occurence) {
			this.occurence = occurence;
		}

		public Enregistrement getSuivant() {
			return suivant;
		}

		public void setSuivant(Enregistrement suivant) {
			this.suivant = suivant;
		}
	}
}
