/* 
 * File:   graphe.c
 * Author: mederic
 *
 * Created on 18 novembre 2011, 15:44
 */

#include "src/controllers/graph_controller.h"
#include <stdlib.h>
#include <stdio.h>

int main(int argc, char** argv) {
    /* Simple test to detect arguments */
    if (argc != 2) {
        perror("ERREUR : nombre d'arguments insuffisants (chemin de fichier recquis)");
        return (EXIT_FAILURE);
    }
    
    /* Init */
    GraphController* ctrl = gctrl_init();

    /* Compute ... */
    gctrl_parse(ctrl, argv[1]);
    gctrl_tag(ctrl);
    
    /* Display*/
    gctrl_stats(ctrl);
    gctrl_print(ctrl);
    gctrl_display(ctrl);
    
    /* Delete */
    gctrl_delete(ctrl);
    
    return (EXIT_SUCCESS);
}
