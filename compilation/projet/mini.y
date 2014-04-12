/*
 * @author Omar EDDASSER
 
 ADD 		+
 SUB 		-
 MUL 		*
 DIV 		/
 PO 		(
 PF 		)
 PV 		;
 READ 		read
 WRITE 		write
 EGAL 		=
 AO 		{
 AF 		}
 COM		commentaire
 NUM		num√©rique 
 IDF 		identificateur
 VG 		virgule
 INT 		int
 VOID 		void
 INF 		< : operateur inferieur
 SUP 		> : operateur superieur
 DIFFEGAL 	!= : operateur different
 IF			if
 ELSE 		else
 WHILE 		while
 RETURN 	return
  
 
 */

%{
    #include "arbre.h"

    Noeud * noeud_racine = NULL;
    Noeud * noeud_courant = NULL;
    Noeud * noeud_courant_precedent = NULL;
    Table * tds = NULL;
    
	char * fonction_courante;
	int nb_parametres_fonction_courante = 0;
	
%}

%union{
    int integer;
    char string[256];
    struct Noeud * Noeud;
}

%start Programme
%token <Noeud *> EGAL VOID DIFFEGAL INF SUP IF ELSE WHILE RETURN
%token <string> COM PO PF PV AO AF VG IDF NUM
%token <integer> ADD SUB MUL DIV INT
%type <Noeud> Atome Facteur Expression AppelFonctionDansExpression AffectationLocale AppelFonction DeclarationAutreIdentificateurLocale AutreExpression DeclarationAutreIdentificateurGlobale Retour Condition
%type <integer> Comparaison

%{
#include <stdio.h>
int yydebug=1; //debug


void verifierIsDoubleDeclarationVariableLocale(char * var){
	if(existe(&tds, var, TDS_VARIABLE_LOCALE) || existe(&tds, var, TDS_VARIABLE_GLOBALE)){ 
		printf("Erreur : la variable '%s' est deja definie.\n", var); 
		exit(EXECUTION_PAS_OK); 
	}
}


void verifierIsDoubleDeclarationVariableGlobale(char * var){
	if(existe(&tds, var, TDS_VARIABLE_GLOBALE)){ 
		printf("Erreur : la variable '%s' est deja definie.\n", var); 
		exit(EXECUTION_PAS_OK); 
	}
}

void verifierIsVariableDefinie(char * var){
	/*
	printf("\n-----------------\n");
	afficherTable(tds);
	printf("\n-----------------\n");
	*/
	if(!existe(&tds, var, TDS_VARIABLE_LOCALE) && !existe(&tds, var, TDS_VARIABLE_GLOBALE) && !existe(&tds, var, TDS_PARAMETRE_FONCTION)){ 
		printf("Erreur : la variable '%s' n'est pas definie.\n", var); 
		exit(EXECUTION_PAS_OK); 
	}
}

void verifierCompatibiliteRetourAppelFonction(char * var){
	char * retour_fonction = rechercherTable(&tds, var, TDS_NOM_FONCTION); 
	if(retour_fonction == NULL || strcmp(retour_fonction, TDS_TYPE_RETOUR_INT) != 0){ 
		printf("Erreur : CompatibilitÈ de type avec la fonction '%s'\n", var); 
		exit(EXECUTION_PAS_OK);
	}
}

void verifierCoherenceNombreDeParametresFonction(char * var){
	int nb = getNbParametresFonction(&tds, var);
/*	printf("fct '%s' attendu : '%d' recu '%d'", var, nb, nb_parametres_fonction_courante); */
	if(nb != nb_parametres_fonction_courante){
		printf("Erreur : Sur le nombre de parametres de la fonction '%s' (%d parametres attendus et non %d) \n", var, nb, nb_parametres_fonction_courante); 
		exit(EXECUTION_PAS_OK);
	}
}

void verifierFonctionAUnRetour(char * var){
	char * retour_fonction = rechercherTable(&tds, var, TDS_NOM_FONCTION);
	if(strcmp(retour_fonction, TDS_TYPE_RETOUR_VOID) == 0){ 
		printf("Erreur : La fonction '%s' ne doit pas avoir de retour \n", var); 
		exit(EXECUTION_PAS_OK);
	}
}

void verifierIsDoubleDeclarationFonction(char * var){
	if(existe(&tds, var, TDS_NOM_FONCTION)){
		printf("Erreur : la fonction '%s' est deja definie.\n", var); 
		exit(EXECUTION_PAS_OK); 
	}
}

void verifierIsFonctionDefinie(char * var){
	if(!existe(&tds, var, TDS_NOM_FONCTION)){
		printf("Erreur : la fonction '%s' n'est pas definie.\n", var); 
		exit(EXECUTION_PAS_OK); 
	}
}

void declarerFonction(char * var, char * retour){
	 nb_parametres_fonction_courante = 0; 
	 fonction_courante = (char *)malloc(sizeof(char)*(strlen(var)+1)); 
	 strcpy(fonction_courante, var);
	 
	 insererTable(&tds, fonction_courante, TDS_NOM_FONCTION, retour);
	 
	 noeud_courant = creerNoeud(TYPE_NOEUD_DECLARATION_FONCTION, fonction_courante); 
	 ajouterFilsDroit(noeud_racine, noeud_courant);
}

void declarerVariableLocale(char * var){
	char * v = (char *)malloc(sizeof(char)*(strlen(var)+1)); 
	strcpy(v, var);
	
	insererTable(&tds, v, TDS_VARIABLE_LOCALE, fonction_courante); 
}

void declarerVariableGlobale(char * var){
	char * v = (char *)malloc(sizeof(char)*(strlen(var)+1)); 
	strcpy(v, var);
	
	insererTable(&tds, v, TDS_VARIABLE_GLOBALE, ""); 	
}

void declarerParametre(char * var){
	char * v = (char *)malloc(sizeof(char)*(strlen(var)+1)); 
	strcpy(v, var);
	
	insererTable(&tds, v, TDS_PARAMETRE_FONCTION, fonction_courante);
}


Noeud * creerNoeudEtAjouterFils(int type, char * val, Noeud * fils1, Noeud * fils2){
	Noeud * n = creerNoeud(type, val);
	
	if(fils1 != NULL){
		ajouterFils(n, fils1);
		if(fils2 != NULL){
			ajouterFils(n, fils2);
		}
	}
	
	return n;
}

void initTableDesSymboles(){
	declarerFonction("read", TDS_TYPE_RETOUR_INT); 
	declarerFonction("write", TDS_TYPE_RETOUR_VOID); 
	insererTable(&tds, "", TDS_PARAMETRE_FONCTION, "write");
	noeud_courant = noeud_racine;
}

void initArbre(){
	noeud_racine = creerNoeud(TYPE_NOEUD_PROGRAMME, "programme"); 
	noeud_courant = noeud_racine;
}


void genererFichier(char * code) {

    printf("%s",code);

    FILE* fichier = NULL;
 
    fichier = fopen("a.uasm", "w");

    if (fichier != NULL) {
        fputs(code, fichier); // Ecriture du caractËre A
        fclose(fichier);
    }

    puts("====== Fichier a.uasm genere avec succes ======");
	
}

 
%}

%%

Programme 			: {initArbre();initTableDesSymboles();} DesInstructionGlobale  {  afficherArbre(noeud_racine, 0); genererFichier(genererCode(noeud_racine, &tds)); return(1);}
;

InstructionGlobale  : COM 
					| DeclarationVariableGlobale 
					| DeclarationFonction 
					| AffectationGlobale 
					| If 
					| While 
					| AppelFonction PV
;

DesInstructionGlobale : InstructionGlobale DesInstructionGlobale 
					|
;

InstructionLocale 	: COM
					| DeclarationVariableLocale
					| AffectationLocale
					| If
					| While
					| Retour
					| AppelFonction PV
;

DesInstructionLocale : InstructionLocale DesInstructionLocale
					| 
;


DeclarationFonction : Type IDF { verifierIsDoubleDeclarationFonction($2); declarerFonction($2, TDS_TYPE_RETOUR_INT); } PO Parametres PF AO DesInstructionLocale AF
					| VOID IDF { verifierIsDoubleDeclarationFonction($2); declarerFonction($2, TDS_TYPE_RETOUR_VOID); } PO Parametres PF AO DesInstructionLocale AF
;

DeclarationVariableLocale : Type IDF DeclarationAutreIdentificateurLocale PV  { verifierIsDoubleDeclarationVariableLocale($2); declarerVariableLocale($2); }
					| Type DeclarationAvecAffectationLocale 
;

DeclarationVariableGlobale : Type IDF DeclarationAutreIdentificateurGlobale PV { verifierIsDoubleDeclarationVariableGlobale($2); declarerVariableGlobale($2); }
					| Type DeclarationAvecAffectationGlobale 
;


DeclarationAvecAffectationLocale 		: IDF DeclarationAutreIdentificateurLocale EGAL Expression PV { verifierIsDoubleDeclarationVariableLocale($1); declarerVariableLocale($1); Noeud * n = creerNoeudEtAjouterFils(TYPE_NOEUD_AFFECTATION, "affectation", creerNoeud(TYPE_NOEUD_IDENTIFICATEUR, $1), $4); ajouterFils(noeud_courant, n); if($2 != NULL) {ajouterFils($2,$4); ajouterFils(noeud_courant, $2);} } 
;

DeclarationAvecAffectationGlobale 		: IDF DeclarationAutreIdentificateurGlobale EGAL Expression PV { verifierIsDoubleDeclarationVariableGlobale($1); declarerVariableGlobale($1); Noeud * n = creerNoeudEtAjouterFils(TYPE_NOEUD_AFFECTATION, "affectation", creerNoeud(TYPE_NOEUD_IDENTIFICATEUR, $1), $4); ajouterFils(noeud_courant, n);  if($2 != NULL) {ajouterFils($2,$4); ajouterFils(noeud_courant, $2);}  }
;

AffectationLocale 		: IDF AutreIdentificateurLocale EGAL Expression PV { verifierIsVariableDefinie($1); 
Noeud * n = creerNoeudEtAjouterFils(TYPE_NOEUD_AFFECTATION, "affectation", creerNoeud(TYPE_NOEUD_IDENTIFICATEUR, $1), $4); ajouterFils(noeud_courant, n);  }
;

AffectationGlobale 		: IDF AutreIdentificateurGlobale EGAL Expression PV { verifierIsVariableDefinie($1); }
;


If 					: IF PO Condition { Noeud * n = creerNoeud(TYPE_NOEUD_IF, "if"); ajouterFils(noeud_courant, n); ajouterFils(n, $3); ajouterFils(n, creerNoeud(TYPE_NOEUD_BLOC, "then")); ajouterFils(n, creerNoeud(TYPE_NOEUD_BLOC, "else")); noeud_courant_precedent = noeud_courant; noeud_courant = n; noeud_courant = getFilsMilieu(noeud_courant); } PF AO DesInstructionLocale AF { noeud_courant = noeud_courant->frere; } Else { noeud_courant = noeud_courant_precedent; }
;

Else 				: ELSE AO DesInstructionLocale AF 
					| 
;

While 				: WHILE PO Condition { Noeud * n = creerNoeud(TYPE_NOEUD_WHILE, "while"); ajouterFils(noeud_courant, n); ajouterFils(n, $3); Noeud * bloc_while = creerNoeud(TYPE_NOEUD_BLOC, "boucle"); ajouterFils(n, bloc_while); noeud_courant_precedent = noeud_courant; noeud_courant = bloc_while; }  PF AO DesInstructionLocale AF { noeud_courant = noeud_courant_precedent; }
;

Condition 			: Expression Comparaison Expression { $$ = creerNoeudEtAjouterFils($2, intToString($2), $1, $3); }
;

Expression 			: Facteur ADD Expression { $$ = creerNoeudEtAjouterFils(TYPE_NOEUD_ADD, "'+'", $1, $3); } 
					| Facteur SUB Expression { $$ = creerNoeudEtAjouterFils(TYPE_NOEUD_SUB, "'-'", $1, $3); } 
					| Facteur { $$ = $1; } 
;

Facteur 			: Atome MUL Facteur { $$ = creerNoeudEtAjouterFils(TYPE_NOEUD_MUL, "'*'", $1, $3); }
					| Atome DIV Facteur { $$ = creerNoeudEtAjouterFils(TYPE_NOEUD_DIV, "'/'", $1, $3); }
					| Atome { $$ = $1; } 
;

Atome 				: NUM { $$ = creerNoeud(TYPE_NOEUD_CONSTANTE, $1); }
					| IDF { $$ = creerNoeud(TYPE_NOEUD_IDENTIFICATEUR, $1); }
					| AppelFonctionDansExpression { $$ = $1; }
					| PO Expression PF { $$ = $2; }
;

AppelFonctionDansExpression : IDF PO {nb_parametres_fonction_courante=0; verifierIsFonctionDefinie($1);} PF { verifierCompatibiliteRetourAppelFonction($1); verifierCoherenceNombreDeParametresFonction($1); $$ = creerNoeud(TYPE_NOEUD_APPEL_FONCTION, $1); }
					| IDF PO Expression {nb_parametres_fonction_courante=1; verifierIsFonctionDefinie($1);} AutreExpression PF { verifierCompatibiliteRetourAppelFonction($1); verifierCoherenceNombreDeParametresFonction($1); $$ = creerNoeud(TYPE_NOEUD_APPEL_FONCTION, $1); ajouterFils($$, $3); }
;

AppelFonction 		: IDF PO {nb_parametres_fonction_courante=0; verifierIsFonctionDefinie($1);} PF { verifierCoherenceNombreDeParametresFonction($1); $$ = creerNoeud(TYPE_NOEUD_APPEL_FONCTION, $1); ajouterFils(noeud_courant, $$); }
					| IDF PO Expression {nb_parametres_fonction_courante=1; verifierIsFonctionDefinie($1); } AutreExpression PF { verifierCoherenceNombreDeParametresFonction($1); $$ = creerNoeud(TYPE_NOEUD_APPEL_FONCTION, $1); ajouterFils(noeud_courant, $$); ajouterFils($$, $3); }
;

Parametres 			: Type IDF { declarerParametre($2); } AutreParametre
					|
;

AutreParametre 		: VG Type IDF { declarerParametre($3); } AutreParametre 
					|
;

AutreExpression 	: VG Expression AutreExpression { nb_parametres_fonction_courante++; $$ = $2; if($3 != NULL){ ajouterFrere($2, $3); } } 
					| { $$ = NULL; }
;

AutreIdentificateurLocale : VG IDF AutreIdentificateurLocale 
					|
;

AutreIdentificateurGlobale : VG IDF AutreIdentificateurGlobale 
					|
;

DeclarationAutreIdentificateurLocale : VG IDF DeclarationAutreIdentificateurLocale { verifierIsDoubleDeclarationVariableLocale($2); declarerVariableLocale($2); $$ = creerNoeudEtAjouterFils(TYPE_NOEUD_AFFECTATION, "affectation", creerNoeud(TYPE_NOEUD_IDENTIFICATEUR, $2), NULL); } 
					| { $$ = NULL; }
;

DeclarationAutreIdentificateurGlobale : VG IDF DeclarationAutreIdentificateurGlobale { verifierIsDoubleDeclarationVariableGlobale($2); declarerVariableGlobale($2); $$ = creerNoeudEtAjouterFils(TYPE_NOEUD_AFFECTATION, "affectation", creerNoeud(TYPE_NOEUD_IDENTIFICATEUR, $2), NULL); }
					| { $$ = NULL; }
;


Retour 				: RETURN Expression PV { verifierFonctionAUnRetour(fonction_courante); $$ = creerNoeud(TYPE_NOEUD_RETURN, fonction_courante); ajouterFils($$, $2); ajouterFils(noeud_courant, $$); }
;

Comparaison 		: INF { $$ = TYPE_NOEUD_INFERIEUR; }
					| SUP { $$ = TYPE_NOEUD_SUPERIEUR; }
					| EGAL EGAL { $$ = 0; }
					| DIFFEGAL { $$ = 0; }
;

Type 				: INT
;


%%

yyerror(char * s){
    printf("\nErreur "); 
}


