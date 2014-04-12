#include <stdio.h>
#include <stdlib.h>

extern int c_comment_counter, shell_comment_counter, other_counter;
extern FILE* yyin;

int main(int argc, char** argv) {
    int total_counter = 0;
    
    /* Parse args */
    if (argc != 2) {
        perror("ERROR: Argument Missing");
        printf("Usage: comments my_file.c\n");
        return (EXIT_FAILURE);
    }
    
    /* Setup Lex */
    yyin = fopen(argv[1], "r");
    yylex();
    
    total_counter = c_comment_counter + shell_comment_counter + other_counter;
    
    printf("Pourcentage de commentaire C:\t\t%d \% (%d)\n", (c_comment_counter*100)/(total_counter), c_comment_counter);
    printf("Pourcentage de commentaire SHELL:\t%d \% (%d)\n", (shell_comment_counter*100)/(total_counter), shell_comment_counter);
    printf("Pourcentage total de commentaire:\t%d \% (%d)\n", ((c_comment_counter+shell_comment_counter)*100)/(total_counter), (c_comment_counter+shell_comment_counter));
    printf("Pourcentage de non-commentaire:\t\t%d \% (%d)\n", (other_counter*100)/(total_counter), other_counter);
    printf("Nombre de caractères:\t\t\t%d\n", total_counter);
    
    return (EXIT_SUCCESS);
}

