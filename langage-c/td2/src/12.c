#include <stdio.h>
#include <stdlib.h>
#include "liste.c"

int main(void) {
  int x = 0;
  int i = 1;
  struct Tlist list, list2, list3;
  
  /*
  // Ajouts manuel
  printf("Saisissez 5 valeurs\n");
  for (i; i <= 5; i++) {
    printf("\nv%d : ", i);
    scanf("%d", &x);
    list_add(list, x); 
  }
  */
  
  // Ajouts automatique
  list_add(&list, 2, 1);
  list_add(&list, 4, 0);
  list_add(&list, 6, 0);
  list_add(&list, 8, 0);
  list_add(&list, 10, 0);
  
  // Affichage
  printf("Liste initiale : ");
  list_print(&list);
  
  // Longueur
  printf("Longueur de la liste : %d\n", list_lenght(&list));
  
  // Membre
  printf("6 membre de la liste : %d\n", list_member(&list, 6));
  printf("13 membre de la liste : %d\n", list_member(&list, 13));
  
  // Retire le dernier élément
  printf("Après suppression du dernier élément : ");
  list_remove_last(&list);
  list_print(&list);
  
  // Concaténation avec une seconde liste
  list_add(&list2, 3, 1);
  list_add(&list2, 5, 0);
  list_add(&list2, 7, 0);
  printf("Liste 2 : ");
  list_print(&list2);
  list3 = list_append(&list, &list2);
  printf("Concaténation des listes : ");
  list_print(&list3);
  
  
  // Libération mémoire
  printf("Libération mémoire\n");
  list_free(&list);
  list_free(&list2);
  list_free(&list3);
}

