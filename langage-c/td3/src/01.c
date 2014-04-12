/* 
 * File:   01.c
 * Author: freax
 *
 * Created on 4 novembre 2011, 14:34
 */

#include <stdio.h>
#include <stdlib.h>
#include <stdarg.h>

#include "liste.c"

/*
 * 
 */
int main(int argc, char** argv) {
    struct Tlist* list = NULL;

    // Ajouts
    list = list_ajout(list, 0);
    list = list_ajout(list, 0);
    list = list_ajout(list, 14);
    list = list_ajout(list, 3);
    list = list_ajout(list, 0);
    list = list_ajout(list, 0);
    list = list_ajout(list, 10);
    list = list_ajout(list, 2);
    list = list_ajout(list, 0);
    list = list_ajout(list, 8);
    list = list_ajout(list, 5);
    list = list_ajout(list, 2);
    list = list_ajout(list, 0);

    // Affichage
    printf("Liste initiale : ");
    list_print(list);

    printf("\n");
    
    printf("Suppression des 0 : ");
    erase_0(list);
    list_print(list);

    printf("\n");

    printf("Nombre d'occurence de 2 : %d\n", list_count(list, 2));

    printf("\n");

    printf("Dernier élément de la liste : %d\n", list_last(list)->nb);

    printf("\n");

    printf("Nouvelle liste avec des éléments plus grand que 3 : \n");
    struct Tlist* list_big3 = NULL;
    list_big3 = list_big(list, 3);
    list_print(list_big3);
    list_free(list_big3);

    printf("\n");

    printf("Liste inversée : \n");
    struct Tlist* list_rev = NULL;
    list_rev = list_reverse(list);
    list_print(list_rev);
    list_free(list_rev);

    printf("\n");

    printf("Liste dynamique : \n");
    struct Tlist* list_dyn = NULL;
    list_dyn = list_dynamic(list_dyn, 4, 10, 20, 30, 40);
    list_print(list_dyn);
    list_free(list_dyn);

    printf("\n");
    
    printf("Tri qsort : \n");
    list_qsort(list, list_compare);
    list_print(list);

    printf("\n");
    
    printf("Filtre élément paire : \n");
    struct Tlist* liste_paire = NULL;
    liste_paire = list_filter(list, list_paire);
    list_print(liste_paire);
    //list_free(liste_paire);

    list_free(list);

    return (EXIT_SUCCESS);
}


