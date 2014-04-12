

#ifndef compilation_table_h
#define compilation_table_h

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "constante.h"


struct Table {
    char * cle1;
    char * cle2;
    char * valeur;
    struct Table * next;
};
typedef struct Table Table;

int insererTable(Table ** table, char * k1, char * k2, char * val);
char * rechercherTable(Table ** table, char * k1, char * k2);
int supprimerTable(Table ** table, char * k1, char * k2);
int longeurTable(Table * table);
void afficherTable(Table * table);


/*
methodes propres a l'usage en tant que table des symboles
 */
int existe(Table ** table, char * k1, char * k2);
int isVariableLocale(Table ** table, char * nom);
int isVariableGlobale(Table ** table, char * nom);
int isParametreFonction(Table ** table, char * nom);
int getNbParametresFonction(Table ** table, char * nom);
int getNbVariableLocalFonction(Table ** table, char * nom);
char * getCodeVariableGlobale(Table ** table);

int getIndiceVariableLocale(Table ** table, char * nom);
int getIndiceParametre(Table ** table, char * nom);


char * concatenation(char * ch1, char * ch2);
char * intToString(int i);

#endif
