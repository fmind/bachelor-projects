/* 
 * File:   graph_controller.h
 * Author: mederic
 *
 * Connected graph algorithms
 * 
 * Created on 18 novembre 2011, 16:11
 */

#ifndef GRAPH_CONTROLLER_H
#define	GRAPH_CONTROLLER_H

#include "../models/node.h"

struct GraphController {
    struct Node* root;      /* Root element */
    int tag_counter;        /* Number of tag (connected graph) */
};
typedef struct GraphController GraphController;

/**
 * Create a graph controller
 * 
 * @return a new graph controller 
 */
GraphController* gctrl_init();

/**
 * Delete a graph controller
 * 
 * @param ctrl
 */
void gctrl_delete(GraphController* ctrl);

/**
 * Parse an input file to build the graph
 *
 * @param ctrl
 * @param path of the file
 * @return 0 on success
 */
int gctrl_parse(GraphController* ctrl, char* path);

/**
 * Tag connected node of the graph
 * 
 * @param ctrl
 * @return 0 on success
 */
int gctrl_tag(GraphController* ctrl);

/**
 * Print the graph datas
 * 
 * @param ctrl
 */
void gctrl_print(GraphController* ctrl);

/**
 * Print some stats about the graph
 * 
 * @param ctrl
 */
void gctrl_stats(GraphController* ctrl);

/**
 * Display the graph using a viewer
 * 
 * @param ctrl
 */
void gctrl_display(GraphController* ctrl);

#endif	/* GRAPH_CONTROLLER_H */

