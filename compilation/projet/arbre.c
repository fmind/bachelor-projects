/*
//  arbre.c
//  tp2bis
//
//  Created by Omar on 17/03/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
 */

/* RAPPEL DES CONVENTIONS :

Appelant :
        - empile les paramètres effectif de la fonction
        - empile un espace (en dessous des paramètres ) pour le résultat de la fonction
        - faire un CALL(label) => l'adresse de retour est dans LP
	
Appelé :
        - empilé la valeur de retour (LP)
        - empilé la valeur de bp (BP) sommet de pile
        - (empilé) reserve les variables locales
        - effectuer les calculs…
        - générer
 */

#include "arbre.h"

int if_indice = 1;
int while_indice = 1;
int noeud_indice = 1;


Noeud * creerNoeud(int type, char * val) {
/*	printf("\nCREATION NOEUD '%d' : '%s' : '%d'\n", type, val); */
	char * s = malloc(sizeof(char) * strlen(val) + 1); 
	strcpy(s, val);

    Noeud * n = (Noeud *) malloc(sizeof (Noeud));
    n->id = noeud_indice;
    noeud_indice++;
    n->type = type;
    n->valeur = s;
    n->fils = NULL;
    n->frere = NULL;
    return n;
}

void ajouterFilsGauche(Noeud * racine, Noeud * fils) {
    fils->frere = racine->fils;
    racine->fils = fils;
}

void ajouterFilsDroit(Noeud * racine, Noeud * fils) {
    if (racine->fils == NULL) {
        /*
         * Le noeud racine n'a pas de fils;
         * on insere directement le noeud fils
         */
        fils->frere = NULL;
        racine->fils = fils;
    } else {
        /*
         * Le noeud racine a des fils
         * on parcours donc la liste de ses fils, jusqu'au dernier
         * et on insere le fils en fin de liste
         */
        fils->frere = NULL;

        Noeud * courant = racine->fils;

        while (courant->frere != NULL) {
            courant = courant->frere;
        }

        courant->frere = fils;

    }
}

void ajouterFils(Noeud * racine, Noeud * fils) {
	ajouterFilsDroit(racine, fils);
}


void ajouterFrere(Noeud * racine, Noeud * frere) {
	if(racine->frere == NULL){
		racine->frere = frere;
	}else{
		Noeud * courant = racine->frere;

        while (courant->frere != NULL) {
            courant = courant->frere;
        }

        courant->frere = frere;

	}
}

Noeud * getFilsGauche(Noeud * n) {
    return n->fils;
}

Noeud * getFilsMilieu(Noeud * n) {
    return n->fils->frere;
}

Noeud * getFilsDroit(Noeud * n) {
    Noeud * droit = n->fils;


    if (droit != NULL) {
        while (droit->frere != NULL) {
            droit = droit->frere;
        }
    }

    return droit;
}

void afficherArbre(Noeud * n, int indentation) {
    char * espacement = malloc(indentation * sizeof (char));
    int i = 0;
    for (i = 0; i < indentation; i++) {
        espacement[i] = '-';
    }

    printf("\n%sNoeud %d - %d - %s", espacement, n->id, n->type, n->valeur);


    printf("\n%sFils : ", espacement);
    if (n->fils == NULL) {
        printf("/");
    } else {
        Noeud * courant = n->fils;
        while (courant != NULL) {
            afficherArbre(courant, indentation + 2);
            courant = courant->frere;
        }
    }

}

/*
 **********************************************************************************************
 * PARTIE GENERATION DU CODE ASSEMBLEUR
 **********************************************************************************************
 */


char * genererCode(Noeud * n, Table ** table) {
    char * code = "";

    switch (n->type) {
        case TYPE_NOEUD_PROGRAMME:
            code = genererCodeProgramme(n, table);
            break;

        case TYPE_NOEUD_DECLARATION_FONCTION:
            code = genererCodeDeclarationFonction(n, table);
            break;

        case TYPE_NOEUD_DECLARATION_VARIABLE:
            code = genererCodeDeclarationVariable(n, table);
            break;

        case TYPE_NOEUD_AFFECTATION:
            code = genererCodeAffectation(n, table);
            break;

        case TYPE_NOEUD_APPEL_FONCTION:
            code = genererCodeAppelFonction(n, table);
            break;

        case TYPE_NOEUD_IF:
            code = genererCodeIf(n, table);
            break;

        case TYPE_NOEUD_WHILE:
            code = genererCodeWhile(n, table);
            break;


        case TYPE_NOEUD_BLOC:
            code = genererCodeBloc(n, table);
            break;

        case TYPE_NOEUD_RETURN:
            code = genererCodeReturn(n, table);
            break;

        case TYPE_NOEUD_IDENTIFICATEUR:
            code = genererCodeIdentificateur(n, table);
            break;

        case TYPE_NOEUD_CONSTANTE:
            code = genererCodeConstante(n, table);
            break;

        case TYPE_NOEUD_ADD:
            code = genererCodeAddition(n, table);
            break;

        case TYPE_NOEUD_SUB:
            code = genererCodeSoustraction(n, table);
            break;

        case TYPE_NOEUD_MUL:
            code = genererCodeMultiplication(n, table);
            break;

        case TYPE_NOEUD_DIV:
            code = genererCodeDivision(n, table);
            break;

        case TYPE_NOEUD_INFERIEUR:
            code = genererCodeInferieur(n, table);
            break;
        case TYPE_NOEUD_SUPERIEUR:
            code = genererCodeSuperieur(n, table);
            break;
           
    }

    return code;
}

/**
 * on parcours tous les fils, et on concatene les codes générés de chacun d'eux
 */
char * genererCodeProgramme(Noeud * n, Table ** table) {
    char * code = "";
    
    code = concatenation(code,".include ../lib/beta.uasm\n");
	code = concatenation(code,".= 0\n\n");
	code = concatenation(code,"BR(main)\n");
    
    code = concatenation(code, getCodeVariableGlobale(table));

    Noeud * courant = n->fils;
    while (courant != NULL) {
        code = concatenation(code, genererCode(courant, table));
        courant = courant->frere;
    }

    return code;
}

/**
 * on concatene le nom de la fonction avec les ":"
 * puis on ajoute le code génére par tous les fils
 */
char * genererCodeDeclarationFonction(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, n->valeur);
    code = concatenation(code, ":\n");

    code = concatenation(code, "\tPUSH(LP)\n");
    code = concatenation(code, "\tPUSH(BP)\n");
    code = concatenation(code, "\tMOVE(SP,BP)\n");

    /*
     ALLOCATION DES VARIABLES LOCALES A LA FONCTION
     */
    int nb_variable_locale = getNbVariableLocalFonction(table, n->valeur);
    if (nb_variable_locale > 0) {
        code = concatenation(code, "\tALLOCATE(");
        code = concatenation(code, intToString(nb_variable_locale));
        code = concatenation(code, ")\n");
    }


    Noeud * courant = n->fils;
    while (courant != NULL) {
        code = concatenation(code, genererCode(courant, table));
        courant = courant->frere;
    }


    /*
    	FIN DE FONCTION
     DESALLOUAGE DES VARIABLES LOCALES
     */
     
    code = concatenation(code, "\nfin_");
    code = concatenation(code, n->valeur);
    code = concatenation(code, ":\n");
    if (nb_variable_locale > 0) {
        code = concatenation(code, "\tDEALLOCATE(");
        code = concatenation(code, intToString(nb_variable_locale));
        code = concatenation(code, ")\n");
    }

    code = concatenation(code, "\tPOP(BP)\n");
    code = concatenation(code, "\tPOP(LP)\n");
    if(strcmp(n->valeur, "main") != 0){
    	code = concatenation(code, "\tRTN()\n");
    }else{
    	code = concatenation(code, "\tHALT()\n");
    }

    return code;
}

/*
 il s'agit bien de variable local (à une fonction)
 
 */
char * genererCodeDeclarationVariable(Noeud * n, Table ** table) {
    char * code = "";

    char * valeur_initale = "0";
    Noeud * fils = getFilsGauche(n);
    if (fils != NULL) {
        valeur_initale = genererCode(fils, table);
    }

    code = concatenation(code, n->valeur);
    code = concatenation(code, ": LONG(");
    code = concatenation(code, valeur_initale);
    code = concatenation(code, ")");

    return code;
}

char * genererCodeAffectation(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, genererCode(getFilsDroit(n), table));
    code = concatenation(code, "POP(R0)\nST(R0,");
	code = concatenation(code, getFilsGauche(n)->valeur);
    code = concatenation(code, ")\n");

    return code;
}

char * genererCodeAppelFonction(Noeud * n, Table ** table) {
    char * code = "";

   /* Noeud* fonction = getFilsGauche(n); */
	Noeud* courant = getFilsGauche(n);
	
	while (courant != NULL) {
		code = concatenation(code, "CMOVE(");
		code = concatenation(code, courant->valeur);
		code = concatenation(code, ", R0)\n");
	    code = concatenation(code, "PUSH(RO)\n");
	    courant = getFilsGauche(courant);
    }
	
	code = concatenation(code, "BR(fin_");
	code = concatenation(code, n->valeur);
	code = concatenation(code, ",LP)\n");
	code = concatenation(code, "MOVE(LP, RO)\n");

    return code;
}

char * genererCodeIf(Noeud * n, Table ** table) {
    char * code = "";

    int ind = if_indice;
    if_indice++;

    /*
     * il va surement falloir gerer les expressions logique (genre < et >)
     * ca devrait fonctionné qu'avec les constantes pour l'instant
     */

    code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, "POP(R0)\n");
    code = concatenation(code, "BF(R0, else");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ")\n");
    code = concatenation(code, "then");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ":\n");

    Noeud * courant = getFilsMilieu(n);
    code = concatenation(code, genererCodeBloc(courant, table));

    code = concatenation(code, "BR(fsi");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ")\n");

    code = concatenation(code, "else");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ":\n");


    courant = getFilsMilieu(n)->frere; /* récuperation du fils droit */
    if (courant != NULL) {
        code = concatenation(code, genererCodeBloc(courant, table));
    }

    code = concatenation(code, "fsi");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ":\n");


    return code;
}

char * genererCodeWhile(Noeud * n, Table ** table) {
    char * code = "";

    int ind = while_indice;
    while_indice++;

    code = concatenation(code, "while");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ":\n");

    code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, "POP(R0)\n");
    code = concatenation(code, "BF(R0, fwhile");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ")\n");

    code = concatenation(code, genererCodeBloc(getFilsMilieu(n), table));
    code = concatenation(code, "BF(R0, while");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ")\n");




    code = concatenation(code, "fwhile");
    code = concatenation(code, intToString(ind));
    code = concatenation(code, ":\n");

    return code;
}

/**
 * on parcours tous les fils, et on concatene les codes générés de chacun d'eux
 */
char * genererCodeBloc(Noeud * n, Table ** table) {
    char * code = "";

    Noeud * courant = n->fils;
    while (courant != NULL) {
        code = concatenation(code, genererCode(courant, table));
        courant = courant->frere;
    }

    return code;
}

char * genererCodeReturn(Noeud * n, Table ** table) {
    char * code = "";

    /*
     * calculer l'expression
     * mettre le resultat au niveau de l'emplacement reservé dans la pile
     */
    char * res = genererCode(getFilsGauche(n), table);
   
   	char * nom_fonction = n->valeur;
   	int nb_parametre = 0;
   	int offset = -4 * (nb_parametre + 2);
    code = concatenation(code, "POP(R0)\nPUTFRAME(R0, ");
	code = concatenation(code, intToString(offset));
    code = concatenation(code, ")\nBR(fin_");
    code = concatenation(code, nom_fonction);
    code = concatenation(code, ")");
	
    return code;
}

/**
Dans le cas d'un identificateur, on ne fait que retourner son nom

		si IDF est globale alors
			LD(idf.nom , R0)
		sinon (IDF est locale)
			GETFRAME(offset, R0) où offset = 4 * (indice de la variable locale)
		sinon (IDF est un paramètre)
			GETFRAME(offset, R0)où offset = (2 + (nombre de parametre - indice de la variable)) * -4
		fsi
		PUSH(R0)
 */
char *genererCodeIdentificateur(Noeud * n, Table ** table) {
	char * code = "";
	
	if(isVariableGlobale(table, n->valeur)){
		code = concatenation(code, "LD(");
		code = concatenation(code, n->valeur);
	}else if(isVariableLocale(table, n->valeur)){
		int offset = 4 * getIndiceVariableLocale(table, n->valeur);
		code = concatenation(code, "GETFRAME(");
		code = concatenation(code, intToString(offset));
	}else{
	/* il s'agit d'un parametre */
		char * nom_fonction = rechercherTable(table, n->valeur, TDS_PARAMETRE_FONCTION);
		int nb_parametre_fonction = getNbParametresFonction(table, nom_fonction);
		int indice_param = getIndiceParametre(table, n->valeur);
		int offset = -4 * (2 + nb_parametre_fonction - indice_param);
		code = concatenation(code, "GETFRAME(");
		code = concatenation(code, intToString(offset));
	}
    
    code = concatenation(code, ", R0)\nPUSH(R0)\n");
	
    return code;
}

/*
Pour une constante, on met sa valeur dans la pile
 */
char *genererCodeConstante(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, "CMOVE(");
    code = concatenation(code, n->valeur);
    code = concatenation(code, ", R0)\nPUSH(R0)\n");

    return code;
}

char *genererCodeAddition(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, genererCode(getFilsDroit(n), table));
    code = concatenation(code, "POP(R1)\n");
    code = concatenation(code, "POP(R0)\n");
    code = concatenation(code, "ADD(R0,R1,R2)\n");
    code = concatenation(code, "PUSH(R2)\n");

    return code;
}

char *genererCodeSoustraction(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, genererCode(getFilsDroit(n), table));
    code = concatenation(code, "POP(R1)\n");
    code = concatenation(code, "POP(R0)\n");
    code = concatenation(code, "SUB(R0,R1,R2)\n");
    code = concatenation(code, "PUSH(R2)\n");

    return code;
}

char * genererCodeMultiplication(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, genererCode(getFilsDroit(n), table));
    code = concatenation(code, "POP(R1)\n");
    code = concatenation(code, "POP(R0)\n");
    code = concatenation(code, "MUL(R0,R1,R2)\n");
    code = concatenation(code, "PUSH(R2)\n");

    return code;
}

char * genererCodeDivision(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, genererCode(getFilsDroit(n), table));
    code = concatenation(code, "POP(R1)\n");
    code = concatenation(code, "POP(R0)\n");
    code = concatenation(code, "DIV(R0,R1,R2)\n");
    code = concatenation(code, "PUSH(R2)\n");

    return code;
}

/* utile pour les comparaisons dans les expressions logiques */
char * genererCodeInferieur(Noeud * n, Table ** table) {
    char * code = "";

    code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, genererCode(getFilsDroit(n), table));
    code = concatenation(code, "POP(R1)\n");
    code = concatenation(code, "POP(R0)\n");
    
    code = concatenation(code, "CMPLT(R1, R0, R0)\n");
    
    
    return code;
}

char * genererCodeSuperieur(Noeud * n, Table ** table) {
    char * code = "";
	
	code = concatenation(code, genererCode(getFilsGauche(n), table));
    code = concatenation(code, genererCode(getFilsDroit(n), table));
    code = concatenation(code, "POP(R1)\n");
    code = concatenation(code, "POP(R0)\n");
    
    code = concatenation(code, "CMPGT(R1, R0, R0)\n");

    return code;
}


