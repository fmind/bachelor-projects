/* 
 * File:   13.c
 * Author: freax
 *
 * Created on 4 novembre 2011, 20:53
 */

#include <stdio.h>
#include <stdlib.h>
#include <math.h>

double f(int i, double(*fct)(double)) {
    return fct(i);
}

/*
 * 
 */
int main(int argc, char** argv) {
    int i = 0;
    for (i; i<20; i++) {
        printf("%d : %f\n", i, f(i, sqrt));
    }
    return (EXIT_SUCCESS);
}

