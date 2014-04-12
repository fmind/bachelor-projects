%{
    int n = 0;
%}
%Start Y
%token add mul po pf const fin
%type <entier> X S A
%union {
    int entier;
}

Y : X fin   {printf("%d\n", $1);};

X : X add S {$$ = $1 + $3;}
  | S       {$$ = $1;}
  ;
S : S mul A {$$ = $1*$3;}
  | A       {$$ = $1;}
  ;
  
A : const   {$$ = $1;} | po X pf {n++; $$ = $2}
  ;
  
yyerror(s) char *s; {printf("%s\n", s);};
main()
{
    yyparse();
    printf("Nb d'expressions avec parenthèses: %d\n", n);
}
