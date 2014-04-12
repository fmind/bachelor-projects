%{
#include "y.tab.h"
%}
separateur [ \t\x0A\x0D]
numerique [0-9]+
identificateur [a-zA-Z][a-zA-Z0-9_]*
commentaire \/\*(([^*])|(\*[^/]))*\*\/
%%
"+"		    { ECHO; return(ADD); }
"-"		    { ECHO; return(SUB); }
"*"		    { ECHO; return(MUL);  }
{commentaire}        {ECHO; return(COM);}
"/"		    { ECHO; return(DIV);  }
"("		    { ECHO; return(PO);   }
")"		    { ECHO; return(PF);   }
";"		    { ECHO; return(PV);   }
"!="		    { ECHO; return(DIFFEGAL);   }
"="		    { ECHO; return(EGAL);   }
"read"      { ECHO; return(READ); }
"write"     { ECHO; return(WRITE); }
"{"		    { ECHO; return(AO);   }
"}"		    { ECHO; return(AF);   }
","		    { ECHO; return(VG);   }
"int"		    { ECHO; return(INT);   }
"void"		    { ECHO; return(VOID);   }
"<"		    { ECHO; return(INF);   }
">"		    { ECHO; return(SUP);   }
"if"		    { ECHO; return(IF);   }
"else"		    { ECHO; return(ELSE);   }
"while"		    { ECHO; return(WHILE);   }
"return"		    { ECHO; return(RETURN);   }
{numerique} { ECHO; strcpy(yylval.string, yytext); return(NUM);}
{identificateur}    {ECHO; return(IDF);}
{separateur}        {ECHO; }
.                   {ECHO; printf("\n\n%s:car. interdit\n",yytext); exit(1); }
%%
int yywrap(){ return(1); }
