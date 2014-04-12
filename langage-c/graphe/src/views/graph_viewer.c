/*
 * File:   graph_viewer.c
 * Author: mederic
 *
 * Created on 27 novembre 2011, 16:26
 */

#include "graph_viewer.h"
#include "../debug.h"
#include "math.h"
#include "time.h"
#include <stdlib.h>

/**
 * Helper : switch two integer values
 * 
 * @param x
 * @param y
 */
void switchInt(int* x, int* y) {
  int t = *x;
  *x = *y;
  *y = t;
}

GraphViewer* gview_init() {
    LOG("Initialisation du visualiseur");

    /* Init structure */
    GraphViewer* gview = malloc(sizeof (GraphViewer));
    gview->height = 600;
    gview->width = 800;
    gview->colors = 32;
    gview->node_size = 30;

    /* Init SDL */
    if (SDL_Init(SDL_INIT_VIDEO) == -1) {
        perror("ERREUR : impossible d'initialiser SDL");
        perror(SDL_GetError());
        exit(EXIT_FAILURE);
    }

    /* Init TTF */
    if (TTF_Init() == -1) {
        perror("ERREUR : impossible d'initialiser SDL");
        perror(TTF_GetError());
        exit(EXIT_FAILURE);
    }

    /* Create a surface to draw */
    gview->surface = SDL_SetVideoMode(gview->width, gview->height, gview->colors, SDL_HWSURFACE);
    if (!gview->surface) {
        perror("ERREUR : impossible d'ouvrir le mode vidéo de SDL");
        perror(SDL_GetError());
        exit(EXIT_FAILURE);
    }

    /* Load a font */
    gview->font = TTF_OpenFont("data/ubuntu.ttf", 13);
    if (!gview->font) {
        perror("ERREUR : police de test introuvable");
        perror(TTF_GetError());
        exit(EXIT_FAILURE);
    }
    
    gview->font_size = 20;
    gview->font_color.r = 0;
    gview->font_color.g = 0;
    gview->font_color.b = 0;

    /* Seed a random generator */
    srand(time(NULL));

    return gview;
}

void gview_delete(GraphViewer* view) {
    LOG("Suppression du visualiseur");

    /* Dispose of SDL surfaces */
    SDL_Quit();

    /* Dispose of TTF polices */
    TTF_CloseFont(view->font);
    TTF_Quit();

    free(view);
}

SDL_Rect gview_generate_position(GraphViewer* view, Node* node) {
    SDL_Rect pos;
    int border = view->node_size * 2;
    int valid = 0;
    int max_test = 0;
    
    /* Try to display it nicely */
    while (!valid && max_test < 100) {
        valid = 1;
        max_test++;
        
        pos.x = rand() % (view->width - border);
        pos.y = rand() % (view->height - border);

        /* Test : inside the surface */
        if (pos.x < border)
            pos.x += border;
        if (pos.y < border)
            pos.y += border;

        /* Test : not superimposed another node */
        Node* cursor = node;
        int right = pos.x + border;
        int left = pos.x - border;
        int bottom = pos.y + border;
        int top = pos.y - border;
        while (cursor) {
            if ((cursor->x < right && cursor->x > left)
                    && (cursor->y < bottom && cursor->y > top)) {
                valid = 0;
                break;
            }
            cursor = cursor->next;
        }
    }

    return pos;
}

int gview_generate_color(GraphViewer* view, Node* node) {
    /* RGB */
    int r, g, b, color;
    int border = SDL_MapRGB(view->surface->format, 255, 255, 255) * 0.1;
    int valid = 0;
    int max_test = 0;

    /* Try to display it nicely */
    while (!valid && max_test < 100) {
        valid = 1;
        max_test++;
        
        r = (rand() % 230) + 25;
        g = (rand() % 230) + 25;
        b = (rand() % 230) + 25;

        color = SDL_MapRGB(view->surface->format, r, g, b);

        /* Test : not the same that another node */
        Node* cursor = node;
        int min = color - border;
        int max = color + border;
        while (cursor) {
            if (cursor->color > min && cursor->color < max) {
                valid = 0;
                break;
            }
            cursor = cursor->next;
        }
    }
    
    return color;
}

/**
 * Source : http://content.gpwiki.org/index.php/SDL:Tutorials:Drawing_and_Filling_Circles#Drawing_a_filled_circle
 */
void gview_draw_circle(GraphViewer* view, int cpx, int cpy, int color) {
    double r = (double) view->node_size / 2.0;
    double dy = 1;

    for (dy = 1; dy <= r; dy += 1.0) {
        double dx = floor(sqrt((2.0 * r * dy) - (dy * dy)));
        int x = cpx - dx;
        Uint8 *target_pixel_a = (Uint8 *) view->surface->pixels + ((int) (cpy + r - dy)) * view->surface->pitch + x * 4;
        Uint8 *target_pixel_b = (Uint8 *) view->surface->pixels + ((int) (cpy - r + dy)) * view->surface->pitch + x * 4;

        for (; x <= cpx + dx; x++) {
            *(int *) target_pixel_a = color;
            *(int *) target_pixel_b = color;
            target_pixel_a += 4;
            target_pixel_b += 4;
        }
    }
}

void gview_draw_text(GraphViewer* view, int cpx, int cpy, char* text) {
    SDL_Surface* text_box = TTF_RenderText_Blended(view->font, text, view->font_color);
    SDL_Rect position;
    position.x = cpx - 3 - strlen(text)*2;
    position.y = cpy - 8;

    /* Draw it on the surface */
    SDL_BlitSurface(text_box, NULL, view->surface, &position);
}

/**
 * Source : http://anomaly.developpez.com/tutoriel/sdl/partie2/#L3.1
 */
void gview_draw_line(GraphViewer* view, int x1, int y1, int x2, int y2, int color) {
    int d, dx, dy, aincr, bincr, xincr, yincr, x, y;

    if (abs(x2 - x1) < abs(y2 - y1)) {
        if (y1 > y2) {
            switchInt(&x1, &x2);
            switchInt(&y1, &y2);
        }

        xincr = x2 > x1 ? 1 : -1;
        dy = y2 - y1;
        dx = abs(x2 - x1);
        d = 2 * dx - dy;
        aincr = 2 * (dx - dy);
        bincr = 2 * dx;
        x = x1;
        y = y1;

        gview_draw_pixel(view, x, y, color);

        for (y = y1 + 1; y <= y2; ++y) {
            if (d >= 0) {
                x += xincr;
                d += aincr;
            } else
                d += bincr;

            gview_draw_pixel(view, x, y, color);
        }

    } else {
        if (x1 > x2) {
            switchInt(&x1, &x2);
            switchInt(&y1, &y2);
        }

        yincr = y2 > y1 ? 1 : -1;
        dx = x2 - x1;
        dy = abs(y2 - y1);
        d = 2 * dy - dx;
        aincr = 2 * (dy - dx);
        bincr = 2 * dy;
        x = x1;
        y = y1;

        gview_draw_pixel(view, x, y, color);

        for (x = x1 + 1; x <= x2; ++x) {
            if (d >= 0) {
                y += yincr;
                d += aincr;
            } else
                d += bincr;

            gview_draw_pixel(view, x, y, color);
        }
    }
}

void gview_draw_pixel(GraphViewer* view, int x, int y, Uint32 color) {
    *((Uint32*)(view->surface->pixels) + x + y * view->surface->w) = color;
}

int gview_populate(GraphViewer* view, Node* node) {
    LOG("Remplissage des noeuds dans le visualiseur...");

    LOG("Première passe (dessin des noeuds)");
    Node* cursor = node;
    while (cursor) {
        gview_add_node(view, cursor);
        cursor = cursor->next;
    }

    LOG("Seconde passe (dessin des connexions)");
    cursor = node;
    while (cursor) {
        gview_add_connections(view, cursor);
        cursor = cursor->next;
    }

    return 0;
}

void gview_add_node(GraphViewer* view, Node* node) {
    /* Properties of the node (name, positions) */
    /* Name*/
    char name[10];
    sprintf(name, "%i", node->id);

    /* Draw a circle and text */
    gview_draw_circle(view, node->x, node->y, node->color);
    gview_draw_text(view, node->x, node->y, name);

    /* Refresh the surface */
    SDL_FreeSurface(view->surface);
    SDL_Flip(view->surface);
}

void gview_add_connections(GraphViewer* view, Node* node) {
    /* Case : node already connected */
    if (node->connected == 1)
        return;

    /* Draw a line for each neighbor */
    int i = 0;
    for (i = 0; i < node->i_neighbors; i++) {
        Node* neighbor = node->neighbors[i];

        /* Case : neighbor already fully connected */
        if (neighbor->connected == 1)
            continue;

        gview_draw_line(view, node->x, node->y, neighbor->x, neighbor->y, node->color);
    }

    /* Node is now connected */
    node->connected = 1;

    /* Refresh the surface */
    SDL_FreeSurface(view->surface);
    SDL_Flip(view->surface);
}

int gview_display(GraphViewer* view) {
    LOG("Affichage de la fenêtre");

    /* Set the window title, and display it */
    SDL_WM_SetCaption("Graphes de composantes connexes", NULL);
    gview_pause(view);

    return 0;
}

void gview_pause(GraphViewer* view) {
    SDL_Event event;

    while (1) {
        SDL_WaitEvent(&event);

        /* Stop the viewer */
        if (event.type == SDL_QUIT) {
            break;
        }
    }
}