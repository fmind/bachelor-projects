/* 
 * File:   graph_viewer.h
 * Author: mederic
 *
 * Display a connected graph using SDL and SDL_ttf
 * 
 * Created on 27 novembre 2011, 16:26
 */

#ifndef GRAPH_VIEWER_H
#define	GRAPH_VIEWER_H

#include "../models/node.h"
#include "SDL/SDL.h"
#include "SDL/SDL_ttf.h"

struct GraphViewer {
    SDL_Surface* surface;       /* surface of painting */
    int height;                 /* heigh of the window */
    int width;                  /* width of the window */
    int colors;                 /* number of colors (bits) */
    int node_size;              /* side of a node (diameter) */
    TTF_Font* font;             /* Font used */
    SDL_Color font_color;       /* Color of the font */
    int font_size;              /* Size of the font */
};
typedef struct GraphViewer GraphViewer;

/**
 * Create a graph viewer
 * 
 * @return a new graph viewer 
 */
GraphViewer* gview_init();
    
/**
 * Delete a graph viewer
 * 
 * @param view
 */
void gview_delete(GraphViewer* view);

/**
 * Generate a random position
 * 
 * @param view
 * @param node ensure a different position from this node
 * @return a random position
 */
SDL_Rect gview_generate_position(GraphViewer* view, Node* node);

/**
 * Generate a random color
 * 
 * @param view
 * @param node ensure a different color from this node
 * @return a random color
 */
int gview_generate_color(GraphViewer* view, Node* node);

/**
 * Draw a filled circle
 * 
 * @param view
 * @param cpx center position x
 * @param cpy center position y
 * @param color filling color
 */
void gview_draw_circle(GraphViewer* view, int cpx, int cpy, int color);

/**
 * Draw a text
 * 
 * @param view
 * @param cpx center position x
 * @param cpy center position y
 * @param text text to draw
 */
void gview_draw_text(GraphViewer* view, int cpx, int cpy, char* text);

/**
 * Draw a line between two points
 * 
 * @param view
 * @param x1 x point 1
 * @param y1 y point 1
 * @param x2 x point 2
 * @param y2 y point 2
 * @param color color of the line
 */
void gview_draw_line(GraphViewer* view, int x1, int y1, int x2, int y2, int color);

/**
 * Draw a pixel
 * 
 * @param view
 * @param x
 * @param y
 * @param color
 */
void gview_draw_pixel(GraphViewer* view, int x, int y, Uint32 color);

/**
 * Populate the graph with nodes
 * 
 * @param view
 * @param node root element
 * @return 0 on success
 */
int gview_populate(GraphViewer* view, Node* node);

/**
 * Add a node to the surface
 * 
 * @param view
 * @param node node element
 */
void gview_add_node(GraphViewer* view, Node* node);

/**
 * Add node connections to the surface
 * 
 * @param view
 * @param node node element
 */
void gview_add_connections(GraphViewer* view, Node* node);

/**
 * Display the graph
 * 
 * @param view
 * @return 0 on success
 */
int gview_display(GraphViewer* view);

/**
 * Pause the viewer to admire this magnificient work
 * 
 * @param view
 */
void gview_pause(GraphViewer* view);

#endif	/* GRAPH_VIEWER_H */

