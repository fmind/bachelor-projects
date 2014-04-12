/* 
 * File:   liste.c
 * Author: freax
 *
 * Created on 4 novembre 2011, 14:45
 */

#include "../../td2/src/liste.c"

struct Tlist* list_ajout(struct Tlist* list, int x) {
    struct Tlist* item = malloc(sizeof(struct Tlist));
    item->nb = x;
    item->next = NULL;

    struct Tlist* current = list;
    if (!list) {
        list = item;
    } else {
        while (current->next != NULL) {
            current = current->next;
        }
        current->next = item;
    }

    return list;
}

int erase_0(struct Tlist* list) {
    struct Tlist* previous = NULL;
    struct Tlist* next = NULL;
    struct Tlist* current = list;
    
    while(current->next) {
        if (current->nb == 0) {
            next = current->next;
            current->nb = next->nb;
            current->next = next->next;
            free(next);

            if (!current->next) break;
        } else {
            previous = current;
            current = current->next;
        }
    }

    if (current->nb == 0) {
        previous->next = NULL;
        free(current);
    }
}

int list_count(struct Tlist* list, int x) {
    int occ = 0;

    struct Tlist* current = list;
    while(current) {
        if (current->nb == x) occ++;
        current = current->next;
    }

    return occ;
}

struct Tlist* list_last(struct Tlist* list) {
    struct Tlist* current = list;
    while (current->next) {
        current = current->next;
    }

    return current;
}

struct Tlist* list_big(struct Tlist* list, int x) {
    struct Tlist* big = NULL;
    struct Tlist* current = list;
    
    while (current) {
        if (current->nb > x) {
            big = list_ajout(big, current->nb);
        }

        current = current->next;
    }
    
    return big;
}

struct Tlist* list_reverse(struct Tlist* list) {
    struct Tlist* rev = NULL;
    struct Tlist* current = list;
    int i = 0;
    int len = list_lenght(list);
    
    int inverse[len];

    while (current) {
        inverse[i] = current->nb;
        current = current->next;
        i++;
    }

    for (i = len; i>0; i--) {
        rev = list_ajout(rev, inverse[i-1]);
    }

    return rev;
}

struct Tlist* list_dynamic(struct Tlist* list, int n, ...) {
    va_list params;
    int i = 0;

    va_start(params, n);
    for (i = 0; i < n; i++) {
        list = list_ajout(list, va_arg(params, int));
    }
    va_end(params);
    
    return list;
}

int list_compare(struct Tlist* a, struct Tlist* b) {
    if (a->nb > b->nb)
        return 1;
    else if (a->nb < b->nb)
        return -1;
    else
        return 0;
}

int list_qsort(struct Tlist* list, int(*compare)(struct Tlist*,struct Tlist* )) {
    int i = 0;
    int trier = 1;

    while (trier) {
        struct Tlist* current = list;
        trier = 0;
        
        while (current->next) {
            if (compare(current, current->next) > 0) {
                int tmp = current->nb;
                current->nb = current->next->nb;
                current->next->nb = tmp;
                trier = 1;
            }

            current = current->next;
        }
    }
}

int list_paire(struct Tlist* list) {
    return !(list->nb % 2);
}

struct Tlist* list_filter(struct Tlist* list, int(*fct)(struct Tlist*)) {
    struct Tlist* filtre = NULL;
    struct Tlist* current = list;

    while (current) {
        if (fct(current)) {
            filtre = list_ajout(filtre, current->nb);
        }
        
        current = current->next;
    }

    return filtre;
}