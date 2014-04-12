/*
 * partie lex du TD mini
 * author : azim.roussanaly@univ-nancy2.fr
 * date: fev 2012
 *(c) Miage Nancy
 */

%{
#include "y.tab.h"
%}
separateur [ \t\x0A\x0D]
numerique [0-9]+
identificateur [a-zA-Z][a-zA-Z0-9_]*
%%
"+"		    { ECHO; return(ADD); }
"-"		    { ECHO; return(SUB); }
"*"		    { ECHO; return(MUL);  }
"/"		    { ECHO; return(DIV);  }
"("		    { ECHO; return(PO);   }
")"		    { ECHO; return(PF);   }
";"		    { ECHO; return(PV);   }
"="		    { ECHO; return(EGAL);   }
"read"      { ECHO; return(READ); }
"write"     { ECHO; return(WRITE); }
{numerique} { ECHO; strcpy(yylval.string, yytext); return(NUM);}
{identificateur}    {ECHO; strcpy(yylval.string, yytext); return(IDF);}
{separateur}        {ECHO; }
.                   {ECHO; printf("\n%s:car. interdit",yytext); exit(1); }
%%
int yywrap(){ return(1); }
