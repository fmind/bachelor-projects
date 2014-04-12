#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int position(char* chaine, char* mot) {
  int i = 0, j = 0, test = 0;
  
  for (i; i <= strlen(chaine)-strlen(mot); i++) {
    if (chaine[i] == mot[0]) {
      test = 1;
      for (j = 0; j < strlen(mot); j++) {
        if (chaine[i+j] != mot[j]) {
          test = 0;
          break;
        }
      }
      if (test) return i;
    }
  }
}


int main(void) {
  char* chaine = "mon langage c, langage java, langage php, langage python";
  char* mot = "langage";
  
  printf("Première occurence de '%s' dans '%s' : %d\n", mot, chaine, position(chaine, mot));
  
  return 0;
}

