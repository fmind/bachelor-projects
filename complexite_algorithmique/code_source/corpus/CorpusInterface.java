package corpus;

/**
 * @author omar
 */
public interface CorpusInterface {
	/**
	 * Ajoute un mot dans la structure de donnée du corpus. Si le mot n'existe
	 * pas, alors il est ajouté dans la structure. S'il existe, son compteur est
	 * incrémenté.
	 * 
	 * @param mot
	 *           Mot à ajouter
	 */
	public void ajouter(String mot);

	/**
	 * 
	 * @param mot
	 *           Valeur à rechercher dans l'arbre.
	 * @return Vrai si <code>mot</code> est présent dans l'arbre, faux sinon.
	 */
	public boolean existe(String mot);

	/**
	 * Compte le nombre d'occurrences du mot passé en paramètre
	 * 
	 * @param mot Chaîne dont on souhaite connaître le nombre d'occurrences.
	 * @return Nombre d'occurences de <code>mot</code>
	 */
	public int occurrences(String mot);

}
