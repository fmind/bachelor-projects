#ifndef tp2bis_arbre_h
#define tp2bis_arbre_h

#include <stdio.h>
#include <stdlib.h>
#include <string.h>


struct Noeud
{
    int id;
	char * type;
	char * valeur;
	struct Noeud * fils;
	struct Noeud * frere;
};

typedef struct Noeud Noeud;



Noeud * creerNoeud(int id, char * type, char * val);
void ajouterFilsGauche(Noeud * racine, Noeud * fils);
void ajouterFilsDroit(Noeud * racine, Noeud * fils);

Noeud * getFilsGauche(Noeud * n);
Noeud * getFilsDroit(Noeud * n);

void afficher(Noeud * n, int indentation);

char * genererCode(Noeud * n);
char * genererCodeProgramme(Noeud * n);
char * genererCodeFonction(Noeud * n);
char * genererCodeInstruction(Noeud * n);
char * genererCodeIndentificateur(Noeud * n);
char * genererCodeConstante(Noeud * n);
char * genererCodeVariable(Noeud * n);
char * concatenation(char * ch1, char * ch2);

#endif
