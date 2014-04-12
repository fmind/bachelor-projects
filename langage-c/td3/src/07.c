/* 
 * File:   07.c
 * Author: freax
 *
 * Created on 4 novembre 2011, 19:28
 */

#include <stdio.h>
#include <stdlib.h>
#include <stdarg.h>

int* dynamic_array(int n, ...) {
    va_list params;
    int i = 0;
    int* T = malloc(n * sizeof (int));
    if (n && !T) abort();

    va_start(params, n);
    for (i = 0; i < n; i++)
        T[i] = va_arg(params, int);
    va_end(params);
    
    return T;
}

/*
 * 
 */
int main(int argc, char** argv) {
    int* tableau = dynamic_array(4, 1, 2, 3, 4);

    return (EXIT_SUCCESS);
}

