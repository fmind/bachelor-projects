#include <stdio.h>
#include <stdlib.h>

struct Tlist
{
  int nb;
  struct Tlist * next;
};

int list_add(struct Tlist* list, int x, int init) {
  if (init == 1) {
    list->nb = x;
    list->next = NULL;
  } else {
    while (list->next) {
      list = list->next;
    }
    struct Tlist* l = malloc(sizeof(struct Tlist));
    l->nb = x;
    list->next = l;
  }
  
  return 0;
}

int list_remove_last(struct Tlist* list) {
  struct Tlist* previous;
  while(list->next) {
    previous = list;
    list = list->next;
  }
  
  previous->next = NULL;
  free(list);
  return 1;
}

struct Tlist list_append(struct Tlist* list1, struct Tlist* list2) {
  struct Tlist list3; 
  int init = 1;
  
  while(list1) {
    list_add(&list3, list1->nb, init);
    list1 = list1->next;
    init = 0;
  }
  
  while(list2) {
    list_add(&list3, list2->nb, init);
    list2 = list2->next;
    init = 0;
  }
  
  return list3;
}

int list_lenght(struct Tlist* list) {
  int i = 0;
  
  while (list) {
    ++i;
    list = list->next;
  }
  
  return i;
}

int list_member(struct Tlist* list, int x) {
  while (list) {
    if (list->nb == x) return 1;
    list = list->next;
  }
  
  return 0;
}


int list_print(struct Tlist* list) {
  while (list) {
    printf("%d ", list->nb);
    list = list->next;
  }
  printf("\n");
}

int list_free(struct Tlist* list) {
  struct Tlist* previous = NULL;

  // Le premier élément n'ayant pas été aloué manuellement (malloc), on passe le premier
  if (list->next) list = list->next;
  
  while (list) {
    previous = list;
    list = list->next;
    free(previous);
  }
}
