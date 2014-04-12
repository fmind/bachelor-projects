#include "arbre.h"


Noeud * creerNoeud(int id, char * type, char * val){
	Noeud * n = (Noeud *) malloc(sizeof(Noeud));
    n->id = id;
	n->type = type;
	n->valeur = val;
    n->fils = NULL;
    n->frere = NULL;
	return n;
}

void ajouterFilsGauche(Noeud * racine, Noeud * fils){
    fils->frere = racine->fils;
    racine->fils = fils;
}

void ajouterFilsDroit(Noeud * racine, Noeud * fils){
    if(racine->fils == NULL){
    /*
     * Le noeud racine n'a pas de fils;
     * on insere directement le noeud fils
     */
        fils->frere = NULL;
        racine->fils = fils;
    }else{
        /*
         * Le noeud racine a des fils
         * on parcours donc la liste de ses fils, jusqu'au dernier
         * et on insere le fils en fin de liste
         */
        fils->frere = NULL;
        
        Noeud * courant = racine->fils;
        
        while(courant->frere != NULL){
            courant = courant->frere;
        }
        
        courant->frere = fils;
        
    }
}


Noeud * getFilsGauche(Noeud * n){
	return n->fils;
}

Noeud * getFilsDroit(Noeud * n){
	Noeud * droit = n->fils;
	
	
	if(droit != NULL){
		while(droit->frere != NULL){
			droit = droit->frere;
		}
	}
	
	return droit;
}


void afficher(Noeud * n, int indentation){
	char * espacement = malloc(indentation * sizeof(char));
	int i = 0;
   	for(i = 0; i < indentation; i++){
   		espacement[i] = '-';
   	}
    
    printf("\n%sNoeud %d - %s - %s", espacement, n->id, n->type, n->valeur);
    
    
    printf("\n%sFils : ", espacement);
    if(n->fils == NULL){
        printf("/");
    }else{
        Noeud * courant = n->fils;
        while(courant != NULL){
            afficher(courant, indentation + 2);
            courant = courant->frere;
        }
    }
   
}


char * genererCode(Noeud * n){
	
	if(strcmp("programme", n->type) == 0){
		return genererCodeProgramme(n);
	}else if(strcmp("fonction", n->type) == 0){
		return genererCodeFonction(n);
	}else if(strcmp("instruction", n->type) == 0){
		return genererCodeInstruction(n);
	}else if(strcmp("identificateur", n->type) == 0){
		return genererCodeIndentificateur(n);
	}else if(strcmp("constante", n->type) == 0){
		return genererCodeConstante(n);
	}else if(strcmp("variable", n->type) == 0){
		return genererCodeVariable(n);
	}else if(strcmp("-", n->type) == 0){
		
	}else if(strcmp("+", n->type) == 0){
		
	}else if(strcmp("", n->type) == 0){
		
	}
	
	return NULL;
}

/**
* on parcours tous les fils, et on concatene les codes générés de chacun d'eux
*/
char * genererCodeProgramme(Noeud * n){
	char * code = "";
	
	Noeud * courant = n->fils;
	while(courant != NULL){
		code = concatenation(code, genererCode(courant));
		courant = courant->frere;
	}
	
	return code;
}

/**
* on concatene le nom de la fonction avec les ":"
* puis on ajoute le code génére par tous les fils
*/
char * genererCodeFonction(Noeud * n){
	char * code = "";
	
	code = concatenation(code, n->valeur);
	code = concatenation(code, ":\n");
		
	Noeud * courant = n->fils;
	while(courant != NULL){
		code = concatenation(code, genererCode(courant));
		courant = courant->frere;
	}
	
	return code;
}

/**
* Selon le type d'instruction (affectation, boucle while, if...), le code généré est différent
*/
char * genererCodeInstruction(Noeud * n){
	char * code = "";
	
	if(strcmp("affectation", n->valeur) == 0){
		code = concatenation(code, genererCode(getFilsDroit(n)));
		code = concatenation(code, "POP(R0)\nST(RO,");
		code = concatenation(code, genererCode(getFilsGauche(n)));
		code = concatenation(code, ")\n");
	}else if(strcmp("boucle", n->valeur) == 0){
	}
	
	return code;
}

/**
Dans le cas d'un identificateur, on ne fait que retourner son nom
*/
char * genererCodeIndentificateur(Noeud * n){
	return n->valeur;
}


/*
Pour une constante, on met sa valeur dans la pile
*/
char * genererCodeConstante(Noeud * n){
	char * code = "";
	
	code = concatenation(code, "CMOVE(");
	code = concatenation(code, n->valeur);
	code = concatenation(code, ", R0)\nPUSH(R0)\n");
	
	return code;
}


char * genererCodeVariable(Noeud * n){
	char * code = "";
	
	code = concatenation(code, "LD(");
	code = concatenation(code, n->valeur);
	code = concatenation(code, ", R0)\nPUSH(R0)\n");
	
	return code;
}


char * concatenation(char * ch1, char * ch2){
	int size1 = strlen(ch1);
	int size2 = strlen(ch2);
	
	
	char * concat = malloc((size1 + size2) * sizeof(char));
	
	int i = 0;
	for(i = 0; i < size1; i++){
		concat[i] = ch1[i];
	}
	
	for(i = 0; i < size2; i++){
		concat[size1 + i] = ch2[i];
	}
	
	return concat;
}




