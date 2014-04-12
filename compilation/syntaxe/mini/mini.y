/*
 * Traduction en yacc dulangage traité en td
 * author : azim.roussanaly@univ-nancy2.fr
 * date: fev 2012
 *(c) Miage Nancy
 */

%union{
    char string[256];
}

%start programme
%token ADD SUB MUL DIV PO PF PV READ WRITE EGAL
%token <string> NUM IDF

%{
#include <stdio.h>
int yydebug=1; //debug
%}

%%
programme   : linstruction {return(1);}
            ;
            
linstruction    : instruction linstruction 
                |
                ;

instruction : affectation
            | ecriture
            ;
            
affectation : IDF EGAL expression PV
            ;
            
ecriture    : WRITE PO expression PF PV
            ;
            
expression	: expression ADD facteur
            | expression SUB facteur
            | facteur 
            ;
facteur		: facteur MUL atome
            | facteur DIV atome
            | atome
            ;
atome		: NUM
            | IDF
            | READ PO PF
            | PO expression PF
            ;
%%

yyerror(char * s){
    printf("\nErreur "); 
}


