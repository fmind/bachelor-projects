#ifndef TABLE_H
#define	TABLE_H

/************************************* Types **********************************/

typedef unsigned long t_size;			/* Size/Length of the table */

/************************************* Structures *****************************/

/*
 * Table key
 */
struct t_key {
    char* part1;        				/* First part of the key */
    char* part2;        				/* Second part of the key */
    char* full;        					/* Concatenation of the parts (reduce CPU usage)*/
};
typedef struct t_key t_key;

/*
 * Table record
 */
struct t_record {
    t_key* key;
    void* data;							/* n-uple */
    struct t_record* next;     			/* Linked list to prevent collisions */
};
typedef struct t_record t_record;

/*
 * Store records by implementing an Hash Table
 */
struct Table {
    t_size length;						/* Length of the Hash Table (without collisions) */
	t_size counter;						/* Counter of records in the table */
    t_record** records;
    t_size (*hashfunction)(char*);      /* Hash function */

};
typedef struct Table Table;

/************************************* Functions ******************************/

/**
 * Initialize a table
 *
 * @param length length of the table (without collisions)
 * @return pointer to the table
 */
Table* table_init(const t_size length);

/**
 * Delete a table and its records
 *
 * @param table
 */
void table_delete(Table* table);

/**
 * Insert a record in the table
 *
 * @param table
 * @param key1 first key
 * @param key2 second key
 * @param data value of the record
 * @return 0 on success
 */
int table_insert(Table* table, char* key1, char* key2, void* data);

/**
 * Delete a record in the table
 *
 * @param table
 * @param key1 first key
 * @param key2 second key
 * @return 0 on success, -1 if no record is founded
 */
int table_remove(Table* table, char* key1, char* key2);

/**
 * Get a record in the table
 *
 * @param table
 * @param key1 first key
 * @param key2 second key
 * @return value of the record or NULL
 */
void* table_get(const Table* table, char *key1, char* key2);

/**
 * Return the number of records in the table
 * 
 * @param table
 * @return number of records in the table
 */
t_size table_count(const Table* table);

/**
 * Display the table
 *
 * @param table
 */
void table_print(const Table* table);

#endif	/* TABLE_H */

