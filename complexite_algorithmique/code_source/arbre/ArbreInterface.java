package arbre;

import corpus.CorpusInterface;

/**
 * Permet de définir les caractères communs aux structures de type arbre
 * 
 * @author Florent
 * 
 */
public interface ArbreInterface extends CorpusInterface {

	/**
	 * Retourne la hauteur de la branche la plus haute de l'arbre depuis le noeud
	 * concerné. Il suffit d'appeler <code>arbre.hauteur(0);</code> pour avoir la
	 * hauteur maximale de l'arbre
	 * 
	 * @param hauteur_depart
	 *           Hauteur du noeud de départ, 0 pour la racine
	 * 
	 * @return hauteur maximale parmi la hauteur de toutes les branches
	 */
	public int hauteur(int hauteur_depart);

	/**
	 * Parcourt l'arbre de façon à ce que l'affichage donne les valeurs triées
	 */
	public void afficher();
}
