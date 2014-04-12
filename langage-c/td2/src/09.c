#include <stdio.h>
#include <stdlib.h>

int max_tab(int *tab, int size) {
  int i = 0, max=0;
  for (i; i<size; i++) {
    if (tab[i] > max) max = tab[i];
  }
  
  return max;
}

int main(void) {
  int tab[] = {1, 4, 20, 12, 100, 2};
  printf("Max de [1, 4, 20, 12, 100, 2] : %d\n", max_tab(tab, 6));
  return 0;
}

