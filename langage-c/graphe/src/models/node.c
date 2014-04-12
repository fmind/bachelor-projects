/*
 * File:   node.c
 * Author: mederic
 *
 * Created on 18 novembre 2011, 16:11
 */

#include "node.h"
#include "../constant.h"
#include <stdlib.h>
#include <stdio.h>

Node* node_init(int id, int nb_neighbors) {
    Node* node = malloc(sizeof(Node));

    node->id = id;
    node->tag = -1;
    node->x = -1;
    node->y = -1;
    node->color = 0;
    node->connected = 0;
    node->nb_neighbors = nb_neighbors;
    node->i_neighbors = 0;
    node->neighbors = malloc(node->nb_neighbors * sizeof(Node*));
    node->next = NULL;

    return node;
}

void node_delete(Node* node, int and_next) {
    /* Protection */
    if (!node)
        return;

    /* delete next */
    if (and_next && node->next) {
        node_delete(node->next, and_next);
    }

    /* delete node */
    free(node->neighbors);
    free(node);
}

Node* node_find_by_id(Node* node, int id) {
    Node* cursor = node;

    while (cursor) {
        if (cursor->id == id)
            return cursor;
        cursor = cursor->next;
    }

    return NULL;
}

int node_add_next(Node* node, Node* next) {
    /* Case no next */
    if (!node->next) {
        node->next = next;
        return 0;
    }

    /* Case with next */
    Node* cursor = node->next;
    while (cursor->next) {
        cursor = cursor->next;
    }
    cursor->next = next;

    return 0;
}

int node_add_neighbor(Node* node, Node* neighbor) {
    /* C index start at 0 */
    node->neighbors[node->i_neighbors] = neighbor;
    node->i_neighbors++;

    return 0;
}

int node_tag(Node* node, int tag_id) {
    int i = 0;

    /* Case node already tagged */
    if (node->tag != -1) {
        return -1;
    }

    /* Case node not tagged */
    node->tag = tag_id;
    for (i=0; i<node->i_neighbors; i++) {
        node_tag(node->neighbors[i], tag_id);
    }

    return 0;
}

void node_print(Node* node) {
#ifdef DEBUG
    int i = 0;
    /* Display id and number of neighbors */
    printf("%d - %d | ", node->id, node->tag);

    /* Display neigbors */
    for (i=0; i<node->i_neighbors; i++) {
        printf("%d ", node->neighbors[i]->id);
    }
    printf("\n");
#endif
}

int node_count(Node* node) {
    int counter = 0;
    Node* cursor = node;

    while (cursor) {
        counter++;
        cursor = cursor->next;
    }

    return counter;
}
