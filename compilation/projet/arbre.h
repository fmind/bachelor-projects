/*
//  arbre.h
//  tp2bis
//
//  Created by Omar on 17/03/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
 */

#ifndef arbre_h
#define arbre_h


#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "table.h"


struct Noeud {
    int id;
    int type;
    char * valeur;
    struct Noeud * fils;
    struct Noeud * frere;
};

typedef struct Noeud Noeud;




Noeud * creerNoeud(int type, char * val);
void ajouterFilsGauche(Noeud * racine, Noeud * fils);
void ajouterFilsDroit(Noeud * racine, Noeud * fils);
void ajouterFils(Noeud * racine, Noeud * fils);
void ajouterFrere(Noeud * racine, Noeud * frere);

Noeud * getFilsGauche(Noeud * n);
Noeud * getFilsMilieu(Noeud * n);
Noeud * getFilsDroit(Noeud * n);

void afficherArbre(Noeud * n, int indentation);





char * genererCode(Noeud * n, Table ** table);
char * genererCodeProgramme(Noeud * n, Table ** table);
char * genererCodeDeclarationFonction(Noeud * n, Table ** table);
char * genererCodeDeclarationVariable(Noeud * n, Table ** table);
char * genererCodeAffectation(Noeud * n, Table ** table);
char * genererCodeAppelFonction(Noeud * n, Table ** table);
char * genererCodeIf(Noeud * n, Table ** table);
char * genererCodeWhile(Noeud * n, Table ** table);
char * genererCodeBloc(Noeud * n, Table ** table);
char * genererCodeReturn(Noeud * n, Table ** table);
char * genererCodeIdentificateur(Noeud * n, Table ** table);
char * genererCodeConstante(Noeud * n, Table ** table);
char * genererCodeAddition(Noeud * n, Table ** table);
char * genererCodeSoustraction(Noeud * n, Table ** table);
char * genererCodeMultiplication(Noeud * n, Table ** table);
char * genererCodeDivision(Noeud * n, Table ** table);
char * genererCodeInferieur(Noeud * n, Table ** table);
char * genererCodeSuperieur(Noeud * n, Table ** table);
	

#endif
