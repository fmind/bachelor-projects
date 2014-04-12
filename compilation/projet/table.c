

#include "table.h"

/*
 methode qui insere un couple cle-cle et lui associe une valeur
 */
int insererTable(Table ** table, char * k1, char * k2, char * val) {
/*	printf("\nINSERTION TABLE '%s':'%s':'%s'\n", k1, k2, val); */
    int res = EXECUTION_OK;
    
    Table * elt = (Table *) malloc(sizeof (Table));
    elt->cle1 = k1;
    elt->cle2 = k2;
    elt->valeur = val;
    elt->next = NULL;

    if (*table == NULL) {
        *table = elt;
    } else {
        int couple_existant = 0;

        Table * courant = *table;
        Table * precedent = courant;
        while (courant != NULL && couple_existant == 0) {
            if (strcmp(courant->cle1, k1) == 0 && strcmp(courant->cle2, k2) == 0) {
                couple_existant = 1;
            }

            precedent = courant;
            courant = courant->next;
        }

        if (couple_existant == 1) {
            /*
             on libere l'espace alloue
             et on procede au remplacement de la valeur
             */
            free(elt);
            precedent->valeur = val;
        } else {
            /*
             sinon on ajoute l'element en fin de liste
             */
            precedent->next = elt;
        }
    }

    return res;
}

/*
 methode qui recherche dans la liste un couple cle-cle
 et qui retourne soit un pointeur vers la chaine
 soit NULL
 */
char * rechercherTable(Table ** table, char * k1, char * k2) {
    char * res = NULL;

    Table * courant = *table;
    while (courant != NULL && res == NULL) {
        if (strcmp(courant->cle1, k1) == 0 && strcmp(courant->cle2, k2) == 0) {
            res = courant->valeur;
        }
        courant = courant->next;
    }

    return res;
}

/*
 methode qui supprime une couple cle-cle dans la table 
 */
int supprimerTable(Table ** table, char * k1, char * k2) {
    int res = EXECUTION_OK;

    Table * courant = *table;

    if (courant != NULL) {
        if (strcmp(courant->cle1, k1) == 0 && strcmp(courant->cle2, k2) == 0) {
            /*
             Cas du première élément à supprimer
             */
            *table = courant->next;
            free(courant);
        } else {
            /*
             Cas d'un élément quelconque de la liste à supprimer
             */
            Table * precedent = courant;
            int trouve = 0;
            while (courant != NULL && trouve == 0) {
                if (strcmp(courant->cle1, k1) == 0 && strcmp(courant->cle2, k2) == 0) {
                    trouve = 1;
                    precedent->next = courant->next;
                    free(courant);
                } else {
                    precedent = courant;
                    courant = courant->next;
                }
            }
        }
    }
    while (courant != NULL) {
        res++;
        courant = courant->next;
    }

    return res;
}

/*
 methode qui retourne la longueur d'une table
 */
int longeurTable(Table * table) {
    int res = 0;
    Table * courant = table;
    while (courant != NULL) {
        res++;
        courant = courant->next;
    }
    return res;
}

/*
 methode qui affiche l'ensemble d'une table (couple cle-cle valeur)
 */
void afficherTable(Table * table) {
    printf("\n\nDebut");
    Table * courant = table;
    while (courant != NULL) {
        printf("\n%s ; %s : %s", courant->cle1, courant->cle2, courant->valeur);
        courant = courant->next;
    }
    printf("\nFin\n");
}

int existe(Table ** table, char * k1, char * k2){
    if(rechercherTable(table, k1, k2) != NULL){
        return TRUE;
    }else{
        return FALSE;
    }
}

int isVariableLocale(Table ** table, char * nom) {
    if (rechercherTable(table, nom, TDS_VARIABLE_LOCALE) != NULL) {
        return TRUE;
    } else {
        return FALSE;
    }
}

int isVariableGlobale(Table ** table, char * nom) {
    if (rechercherTable(table, nom, TDS_VARIABLE_GLOBALE) != NULL) {
        return TRUE;
    } else {
        return FALSE;
    }
}

int isParametreFonction(Table ** table, char * nom) {
    if (rechercherTable(table, nom, TDS_PARAMETRE_FONCTION) != NULL) {
        return TRUE;
    } else {
        return FALSE;
    }
}

int getNbParametresFonction(Table ** table, char * nom) {
    int nb = 0;

    Table * courant = *table;
    while (courant != NULL) {
        if (strcmp(courant->valeur, nom) == 0 && strcmp(courant->cle2, TDS_PARAMETRE_FONCTION) == 0) {
            nb++;
        }
        courant = courant->next;
    }

    return nb;
}

int getNbVariableLocalFonction(Table ** table, char * nom) {
    int nb = 0;

    Table * courant = *table;
    while (courant != NULL) {
        if (strcmp(courant->valeur, nom) == 0 && strcmp(courant->cle2, TDS_VARIABLE_LOCALE) == 0) {
            nb++;
        }
        courant = courant->next;
    }

    return nb;
}

char * getCodeVariableGlobale(Table ** table) {
    char * code = "";

    Table * courant = *table;
    while (courant != NULL) {
        if (strcmp(courant->cle2, TDS_VARIABLE_GLOBALE) == 0) {
            code = concatenation(code, courant->cle1);
            code = concatenation(code, ": LONG(0)\n");
        }
        courant = courant->next;
    }

    return code;
}


int getIndiceVariableLocale(Table ** table, char * nom){
	char * nom_fonction = rechercherTable(table, nom, TDS_VARIABLE_LOCALE);
	
	int indice = 0;
	
	Table * courant = *table;
    while (courant != NULL) {
        if (strcmp(courant->valeur, nom_fonction) == 0 && strcmp(courant->cle2, TDS_VARIABLE_LOCALE) == 0) {
            if(strcmp(courant->cle1, nom) == 0){
            	return indice;
            }else{
            	indice++;
            }
        }
        courant = courant->next;
    }
	
	
	return indice;
}

int getIndiceParametre(Table ** table, char * nom){
	char * nom_fonction = rechercherTable(table, nom, TDS_PARAMETRE_FONCTION);
    
	int indice = 0;
	
	Table * courant = *table;
    while (courant != NULL) {
        if (strcmp(courant->valeur, nom_fonction) == 0 && strcmp(courant->cle2, TDS_PARAMETRE_FONCTION) == 0) {
            if(strcmp(courant->cle1, nom) == 0){
            	return indice;
            }else{
            	indice++;
            }
        }
        courant = courant->next;
    }
	
	
	return indice;
}


/*
 **********************************************************************************************
 * PARTIE METHODE GENERIQUE UTILISEES DANS LA GENERATION DE CODE ASSEMBLEUR
 **********************************************************************************************
 */

/*
char * genererCodeVariable(Noeud * n) {
    char * code = "";

    code = concatenation(code, "LD(");
    code = concatenation(code, n->valeur);
    code = concatenation(code, ", R0)\nPUSH(R0)\n");

    return code;
}
 */

char * concatenation(char * ch1, char * ch2) {
    int size1 = strlen(ch1);
    int size2 = strlen(ch2);


    char * concat = malloc((size1 + size2) * sizeof (char));

    int i = 0;
    for (i = 0; i < size1; i++) {
        concat[i] = ch1[i];
    }

    for (i = 0; i < size2; i++) {
        concat[size1 + i] = ch2[i];
    }

    return concat;
}

char * intToString(int i) {
    char * chaine = malloc(2 * sizeof (char));
    sprintf(chaine, "%d", i);
    return chaine;
}

