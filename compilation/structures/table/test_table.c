#include "table.h"
#include <stdio.h>
#include <stdlib.h>

/*
 * Test the table structure with "Candidats à l'élection présidentielle française de 2012"
 *
 * http://fr.wikipedia.org/wiki/%C3%89lection_pr%C3%A9sidentielle_fran%C3%A7aise_de_2012#Candidats_d.C3.A9clar.C3.A9s
 */
int main(int argc, char** argv) {
	Table* t = NULL;
    t_size length = 255;  			/* Default table length */

	/* Check args */
    if (argc == 2) {
		length = atol(argv[1]);    	/* Custom table length */
    }
	
    /* Initialization*/
    printf("INITIALIZATION\n");
    t = table_init(length);
    printf("Number of bucket: %ld\n", t->length);
    printf("Number of record: %ld\n", table_count(t));
    table_print(t);
    printf("\n");

    /* Insert records */
    printf("INSERTIONS\n");
    table_insert(t, "Nathalie", "Arthaud", "Lutte ouvrière");
    table_insert(t, "Philippe", "Poutou", "Nouveau Parti anticapitaliste");
    table_insert(t, "Jean-Luc", "Mélenchon", "Front de gauche");
    table_insert(t, "Jean-Pierre", "Chevènement", "Mouvement républicain et citoyen");
    table_insert(t, "François", "Hollande", "Parti radical de gauche");
    table_insert(t, "François", "Hollande", "Génération écologie");
    table_insert(t, "François", "Hollande", "Mouvement unitaire progressiste");
    table_insert(t, "François", "Hollande", "Parti socialiste");
    table_insert(t, "Eva", "Joly", "Europe Écologie Les Verts");
    table_insert(t, "Eva", "Joly", "Mouvement écologiste indépendant");
    table_insert(t, "Eva", "Joly", "Fédération régions et peuples solidaires");
    table_insert(t, "Eva", "Joly", "Europe Écologie Les Verts");
    table_insert(t, "Corinne", "Lepage", "Cap21");
    table_insert(t, "François", "Bayrou", "Mouvement démocrate");
    table_insert(t, "Hervé", "Morin", "Nouveau Centre");
    table_insert(t, "Dominique", "de Villepin", "République solidaire");
    table_insert(t, "Christine", "Boutin", "Parti chrétien-démocrate");
    table_insert(t, "Nicolas", "Sarkozy", "Union pour un mouvement populaire");
    table_insert(t, "Frédéric", "Nihous", "Chasse, pêche, nature et traditions");
    table_insert(t, "Nicolas", "Dupont-Aignan", "Debout la République");
    table_insert(t, "Marine", "Le Pen", "Front national");
    table_print(t);
    printf("Number of records: %ld\n", table_count(t));

    /* Remove records */
    printf("\nREMOVE 3 RECORDS\n");
    table_remove(t, "Nicolas", "Sarkozy");
    table_remove(t, "Marine", "Le Pen");
    table_remove(t, "Frédéric", "Nihous");
    table_remove(t, "Médéric", "Hurier");
    table_print(t);
    printf("Number of records: %ld\n", table_count(t));

    /* Get record */
    printf("\nSEARCHS\n");
    printf("Eva Joly: %s\n", (char*)table_get(t, "Eva", "Joly"));
    printf("François Bayrou: %s\n", (char*)table_get(t, "François", "Bayrou"));
    printf("Médéric Hurier: %s\n", (char*)table_get(t, "Médéric", "Hurier"));

    /* Delete the table */
    printf("\nDELETE TABLE\n");
    table_delete(t);

	printf("\nBye bye ...\n");

    return (EXIT_SUCCESS);
}

