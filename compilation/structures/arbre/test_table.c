/*
//  main.c
//  tp2bis
//
//  Created by Omar on 17/03/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
*/
#include "arbre.h"

int main (int argc, const char * argv[])
{
    
    printf("\n\nDebut");
    
    
    int ind = 0;
    
    Noeud * racine = creerNoeud(ind, "programme", "programme");
    ind++;
    
    
    Noeud * n1 = creerNoeud(ind, "fonction", "main");
    ind++;
    ajouterFilsGauche(racine, n1);
    
    Noeud * n2 = creerNoeud(ind, "instruction", "affectation");
    ind++;
    ajouterFilsGauche(n1, n2);
    
    
    Noeud * n3 = creerNoeud(ind, "identificateur", "i");
    ind++;
    ajouterFilsGauche(n2, n3);
    
    Noeud * n4 = creerNoeud(ind, "constante", "0");
    ind++;
    ajouterFilsDroit(n2, n4);
    
    
    afficher(racine, 0);

    
    printf("\n\nCode:\n%s", genererCode(racine));
    
    printf("\nFin\n");
    return 0;
}
