/* A scanner for C and SHELL comments */

                int c_comment_counter = 0;
                int shell_comment_counter = 0;
                int other_counter = 0;

C_COMMENT       \/\*(([^*])|(\*[^/]))*\*\/
SHELL_COMMENT   #[^\n]*\n

%%

{C_COMMENT}         { c_comment_counter += yyleng;      }
{SHELL_COMMENT}     { shell_comment_counter += yyleng;  }
.                   { other_counter++;                  }

%%

int yywrap(void)                { return 1; }
int yyerror(const char *msg)    { fprintf(stderr,"Error:%s\n",msg); return 0; }
