/*
 * File:   graph_controller.c
 * Author: mederic
 *
 * Created on 18 novembre 2011, 16:11
 */

#include "graph_controller.h"
#include "../debug.h"
#include "../utils/io.h"
#include "../views/graph_viewer.h"
#include <stdlib.h>

GraphController* gctrl_init() {
    LOG("Initialisation du controlleur");
    
    GraphController* gctrl = malloc(sizeof(GraphController));
    gctrl->root = NULL;
    gctrl->tag_counter = 0;
    
    return gctrl;
}

void gctrl_delete(GraphController* ctrl) {
    LOG("Suppression du controlleur");
    
    node_delete(ctrl->root, 1);
    
    free(ctrl);
}

/**
 * Test
 * - Empty line (begining, middle, end) => pass
 * - Neighbor not referenced => error
 * - Not the same value at the first and second reading => error
 * - Tested with 40 values
 * - Tested with negative values
 */
int gctrl_parse(GraphController* ctrl, char* path) {
    LOG("Analyse du fichier de données");
    LOG(path);

    int value;
    IO* io = io_init(path);
    
    LOG("Première lecture (ajout valeurs)");
    while (io_read_next_value(io, &value) == 0) {
        /* Create a new node */
        int nb_neighbors = io_go_next_line(io);
        Node* node = node_init(value, nb_neighbors);
        
        /* Add the node to the controller */
        if (!ctrl->root) {
            ctrl->root = node;
        } else {
            node_add_next(ctrl->root, node);
        }        
    }

    io_rewind(io);
    
    LOG("Seconde lecture (ajout voisins)");
    Node* cursor = ctrl->root;
    while (cursor) {
        /* Test the ID on the second reading */
        io_read_next_value(io, &value);
        if (value != cursor->id) {
            perror("ERREUR : lecture d'un noeud voisin n'ayant pas le même ID lors de la seconde lecture");
            printf("en première lecture: %d, en deuxième lecture: %d\n", cursor->id, value);
            exit(EXIT_FAILURE);
        }

        /* Read neighbors */
        while (!io_eol(io)) {
            io_read_next_value(io, &value);
            Node* neighbor = node_find_by_id(ctrl->root, value);
            
            if (!neighbor) {
                perror("ERREUR : lecture d'un noeud voisin non référencé dans la liste");
                printf("noeud voisin: %d\n", value);
                exit(EXIT_FAILURE);
            }
            node_add_neighbor(cursor, neighbor);
        }
        cursor = cursor->next;
    }
    
    io_close(io);

    return 0;
}

int gctrl_tag(GraphController* ctrl) {
    LOG("Tag des graphes - recherche des composantes connexes");
    
    Node* cursor = ctrl->root;
    ctrl->tag_counter = 1;
    while (cursor) {
        /* Increment the tag counter on success */
        if (node_tag(cursor, ctrl->tag_counter) == 0) {
            ctrl->tag_counter++;
        }
        cursor = cursor->next;
    }
    
    /* Decrement the tag counter to have the true number */
    ctrl->tag_counter--;
    
    return 0;
}

void gctrl_print(GraphController* ctrl) {
    LOG("Affichage des données du graphe");
    LOG("ID - graphe | voisins");
    
    Node* cursor = ctrl->root;
    while (cursor) {
        node_print(cursor);
        cursor = cursor->next;
    }
}

void gctrl_stats(GraphController* ctrl) {
    LOG("Affichage des statistiques du graphe");
    
    printf("Nombre de valeurs : %d \n", node_count(ctrl->root));
    printf("Nombre de composantes connexes : %d\n", ctrl->tag_counter);
}

void gctrl_display(GraphController* ctrl) {
    LOG("Affichage du graphe");
    int i = 1;
    
    /* Init */
    GraphViewer* viewer = gview_init();
    
    /* Compute ... */
    LOG("Ajout des attributs graphiques");
    for (i = 1; i <= ctrl->tag_counter; i++) {
        Node* cursor = ctrl->root;
        int color = gview_generate_color(viewer, ctrl->root);
        
        while (cursor) {
            if (cursor->tag == i) {
                SDL_Rect position = gview_generate_position(viewer, ctrl->root);
                cursor->x = position.x;
                cursor->y = position.y;
                cursor->color = color;
            }
            cursor = cursor->next;
        }
    }

    /* Add node to the graph */
    gview_populate(viewer, ctrl->root);
    
    /* Display */
    gview_display(viewer);
    
    /* Delete */
    gview_delete(viewer);
}
