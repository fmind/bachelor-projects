/*
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
 NUM		numérique 
 IDF 		identificateur
 VG 		virgule
 INT 		int
 VOID 		void
 INF 		< : operateur inférieur
 SUP 		> : operateur supérieur
 DIFFEGAL 	!= : operateur différent
 IF			if
 ELSE 		else
 WHILE 		while
 RETURN 	return
  
 
 */

%{
	
%}

%union{
    char string[256];
    struct Noeud * arbre;
}

%start Programme
%token ADD SUB MUL DIV PO PF PV READ WRITE EGAL AO AF VG INT VOID DIFFEGAL INF SUP IF ELSE WHILE RETURN
%token <string> NUM IDF COM

%{
#include <stdio.h>
int yydebug=1; //debug
%}

%%

Programme 			: InstructionGlobale  {return(1);}
;

InstructionGlobale  : InstructionGlobale InstructionGlobale 
					| COM 
					| DeclarationVariable 
					| DeclarationFonction 
					| Affectation 
					| Ecriture 
					| If 
					| While 
					| AppelFonction
					|
;

InstructionLocale 	: COM 
					| DeclarationVariable 
					| Affectation 
					| Ecriture 
					| If 
					| While 
					| Retour 
					| InstructionLocale InstructionLocale 
					| AppelFonction PV
					| 
;		

DeclarationFonction : Type IDF PO Parametres PF AO InstructionLocale AF 
					| VOID IDF PO Parametres PF AO InstructionLocale AF
;

DeclarationVariable : Type IDF PV 
					| Type IDF AutreIdentificateur PV
					| Type Affectation 
;

Affectation 		: IDF AutreIdentificateur EGAL Expression PV
;

Ecriture 			: WRITE PO Expression PF PV
;

If 					: IF PO Condition PF AO InstructionLocale AF Else
;

Else 				: ELSE AO InstructionLocale AF 
					|
;

While 				: WHILE PO Condition PF AO InstructionLocale AF
;

Condition 			: Expression Comparaison Expression
;

Expression 			: Expression ADD Facteur 
					| Expression SUB Facteur 
					| Facteur
;

Facteur 			: Facteur MUL Atome 
					| Facteur DIV Atome 
					| Atome
;

Atome 				: NUM
					| IDF 
					| Lecture 
					| AppelFonction 
					| PO Expression PF
;

AppelFonction 		: IDF PO PF
					| IDF PO Expression AutreExpression PF
;

Parametres 			: Type IDF AutreParametre 
					|
;

AutreParametre 		: VG Type IDF AutreParametre 
					|
;

AutreExpression 	: VG Expression AutreExpression 
					|
;

AutreIdentificateur : VG IDF AutreIdentificateur 
					|
;

Retour 				: RETURN Expression PV
;

Comparaison 		: INF 
					| SUP
					| EGAL EGAL 
					| DIFFEGAL
;

Lecture 			: READ PO PF
;

Type 				: INT
;


%%

yyerror(char * s){
    printf("\nErreur "); 
}


