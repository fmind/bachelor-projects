#include <stdio.h>
#include <stdlib.h>

int * add_tab(int *tab, int *size, int elmt) {
  int new_size = *size+1;
  int decalage = 0;
  int i = 0;
  int temp = 0;
  
  tab = realloc(tab, sizeof(int)*new_size);

  for (i; i<=new_size; i++) {
    if (elmt <= tab[i] && !decalage) {
      temp = tab[i];
      tab[i] = elmt;
      decalage = 1;
    } else if (decalage) {
      elmt = tab[i];
      tab[i] = temp;
      temp = elmt;
    }
  }
  
  *size = new_size;
  
  return tab;
}

void affiche(int *tab, int size) {
  int i = 0;
  printf("\nTableau : ");
  for (i; i < size; i++) {
    printf("%d ", tab[i]);
  }
  printf("\n");
}

int main(void) {
  int size = 6;
  int* tab = malloc(size*sizeof(int));
  tab[0] = 2;
  tab[1] = 4;
  tab[2] = 6;
  tab[3] = 8;
  tab[4] = 10;
  tab[5] = 12;

  affiche(tab, size);
  printf("Ajout 5");
  tab = add_tab(tab, &size, 5);
  affiche(tab, size);
  printf("Ajout 7");
  tab = add_tab(tab, &size, 7);
  affiche(tab, size);
  printf("Ajout 13");
  tab = add_tab(tab, &size, 13);
  affiche(tab, size);
  
  return 0;
}

