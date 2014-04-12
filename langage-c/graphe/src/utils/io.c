/*
 * File:   io.c
 * Author: mederic
 *
 * Created on 18 novembre 2011, 16:11
 */

#include "io.h"
#include "../debug.h"
#include "../models/node.h"
#include <stdlib.h>

IO* io_init(char* path) {
    LOG("Ouverture du fichier de données");
    
    IO* io = malloc(sizeof(IO));
    io->file = fopen(path, "r");

    if (!io->file) {
        perror("ERREUR : impossible d'ouvrir le fichier données");
        exit(EXIT_FAILURE);
    }

    return io;
}

int io_eol(IO* io) {
    if (feof(io->file) || fgetc(io->file) == 10)
        return 1;
    return 0;
}

int io_rewind(IO* io) {
    LOG("Rembobinage du fichier de données");
    
    if (io->file) {
        rewind(io->file);
    }
    
    return 0;
}

int io_go_next_line(IO* io) {
    int counter = 0;
    int value = 0;
    
    while (!feof(io->file)) {
        if (io_eol(io))
            break;
        fscanf(io->file, "%d", &value);
        counter++;
    }
    
    return counter;
}

int io_read_next_value(IO* io, int* value) {
    /* Already end of the file */
    if (feof(io->file))
        return -1;
        
    /* Read the first integer value */
    fscanf(io->file, "%d", value);
    
    /* End of the file now ? */
    if (feof(io->file))
        return -1;

    return 0;
}

int io_close(IO* io) {
    LOG("Fermeture du fichier de données");
    
    if (io->file) {
        fclose(io->file);
    }
    free(io);
    
    return 0;
}
