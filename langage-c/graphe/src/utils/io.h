/*
 * File:   io.h
 * Author: mederic
 *
 * Handle all application Input/Output
 *
 * Created on 18 novembre 2011, 15:59
 */

#ifndef IO_H
#define	IO_H

#include <stdio.h>

struct IO {
    FILE* file;     /* File handled */
};
typedef struct IO IO;

/**
 * Initialise a IO structure with a file path
 *
 * @param path the file path
 * @return a new IO handler
 */
IO* io_init(char* path);

/**
 * Test the end of the line (or end of line)
 * 
 * @param io
 * @return 1 on eol, 0 if not
 */
int io_eol(IO* io);

/**
 * Go back to the begining of the file
 * 
 * @param io
 * @return 0 on success
 */
int io_rewind(IO* io);

/**
 * Jump to the next line of the file.
 * 
 * @param io
 * @return number of unread values
 */
int io_go_next_line(IO* io);

/**
 * Read the next value of the line
 * 
 * @param io
 * @param value int buffer to store the value
 * @return 0 on success
 */
int io_read_next_value(IO* io, int* value);

/**
 * Close structure
 *
 * @param io
 * @return 0 on success
 */
int io_close(IO* io);

#endif	/* IO_H */