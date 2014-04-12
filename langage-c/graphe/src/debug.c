/*
 * File:   debug.c
 * Author: mederic
 *
 * Created on 23 novembre 2011, 09:03
 */

#include "debug.h"
#include "constant.h"
#include <stdio.h>

/**
 * Log a message to the developer
 * 
 * @param mess
 */
void LOG(char* mess) {
#ifdef DEBUG
    printf("-- %s\n", mess);
#endif
}
