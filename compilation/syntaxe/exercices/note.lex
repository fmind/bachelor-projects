%{
#include "y.tab.h"
%}

%%
\n          {return(fin);}
\+          {return(add);}
\*          {return(mul);}
\(          {return(po);}
\)          {return(pf);}
[0-9]+      {(yyval) return (const);}
%%

yywrap()    {return(1);}
