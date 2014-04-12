package corpus;

/**
 * @author omar
 */
public interface CorpusInterface {
	/**
	 * Ajoute un mot dans la structure de donn�e du corpus. Si le mot n'existe
	 * pas, alors il est ajout� dans la structure. S'il existe, son compteur est
	 * incr�ment�.
	 * 
	 * @param mot
	 *           Mot � ajouter
	 */
	public void ajouter(String mot);

	/**
	 * 
	 * @param mot
	 *           Valeur � rechercher dans l'arbre.
	 * @return Vrai si <code>mot</code> est pr�sent dans l'arbre, faux sinon.
	 */
	public boolean existe(String mot);

	/**
	 * Compte le nombre d'occurrences du mot pass� en param�tre
	 * 
	 * @param mot Cha�ne dont on souhaite conna�tre le nombre d'occurrences.
	 * @return Nombre d'occurences de <code>mot</code>
	 */
	public int occurrences(String mot);

}
