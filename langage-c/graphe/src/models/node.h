/* 
 * File:   node.h
 * Author: mederic
 *
 * Structure and methods for a theory graph node
 * 
 * Created on 18 novembre 2011, 16:03
 */

#ifndef NODE_H
#define	NODE_H


struct Node {
  int id;                   /* value of the node */
  int tag;                  /* id of a connected graph */
  int x;                    /* x position */
  int y;                    /* y position */
  int color;                /* color of the node */
  int connected;            /* 1 when fully and graphicaly connected */
  int nb_neighbors;         /* number of neighbors */
  int i_neighbors;          /* index of neighbors (filling) */
  struct Node** neighbors;  /* neighbor node (array) */
  struct Node* next;        /* next node (linked list) */
};
typedef struct Node Node;

/**
 * Create a node
 * 
 * @param id id of the node
 * @param nb_neighbors number of neighbors
 * @return a new node 
 */
Node* node_init(int id, int nb_neighbors);

/**
 * Delete a node element
 * 
 * @param node
 * @param and_next also delete the next node
 */
void node_delete(Node* node, int and_next);

/**
 * Find a node in the list by its id
 * 
 * @param node
 * @param id node id to find
 * @return node with the given id or NULL
 */
Node* node_find_by_id(Node* node, int id);

/**
 * Add a node to the linked list
 * 
 * @param node
 * @param next a new node to add
 * @return 0 on success
 */
int node_add_next(Node* node, Node* next);

/**
 * Add a neighbor to a node
 * 
 * @param node
 * @param neighbor neighbor node to add
 * @return 0 on success
 */
int node_add_neighbor(Node* node, Node* neighbor);

/**
 * Tag a node and its neighbors recursively with an ID
 * 
 * @param node
 * @param tag_id id of the connected graph
 * @return 0 on success
 */
int node_tag(Node* node, int tag_id);

/**
 * Display a node (only on DEBUG)
 * 
 * @param node
 */
void node_print(Node* node);

/**
 * Return the number of nodes in the list
 * 
 * @param node
 * @return number of nodes
 */
int node_count(Node* node);

#endif	/* NODE_H */
