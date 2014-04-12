/* 
 * File:   09.c
 * Author: freax
 *
 * Created on 4 novembre 2011, 19:40
 */

#include <stdio.h>
#include <stdlib.h>

int compare(const void *a, const void *b) {
    int va = *(int*)a;
    int vb = *(int*)b;

    if (va > vb)
        return 1;
    else if (va < vb)
        return -1;
    else
        return 0;
}

/*
 * 
 */
int main(int argc, char** argv) {
    int vals[] = {5,2,7,3,9,1,8,6,4};
    int i = 0;

    printf("Affichage de la liste non triée:\n");
    for (i=0; i<9; i++) {
        printf("%d - ", vals[i]);
    }

    printf("\n\n");
    
    printf("Affichage de la liste triée:\n");
    qsort(vals, 9, sizeof(int), compare);
    for (i=0; i<9; i++) {
        printf("%d - ", vals[i]);
    }

    printf("\n");

    return (EXIT_SUCCESS);
}

