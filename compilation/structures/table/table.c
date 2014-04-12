#include "table.h"
#include <stdlib.h>
#include <stdio.h>
#include <string.h>

/************************************* Private functions **********************/

/**
 * Default hash function
 *
 * @note implements SDBM Hashing function : http://www.cse.yorku.ca/~oz/hash.html
 */
t_size hash(char *key) {
    t_size h = 0;
    while(*key) h=*key++ + (h<<6) + (h<<16) - h;
    return h;
}

/**
 * Initialize a key
 *
 * @param key1
 * @param key2
 * @return a pointer to the key
 */
t_key* key_init(char* part1,char* part2) {
    t_key* k = malloc(sizeof(t_key));

    k->part1 = part1;
    k->part2 = part2;
    k->full = malloc(sizeof(char) * (strlen(part1) + strlen(part2)));
    strcpy(k->full, part1);
    strcat(k->full, part2);

    return k;
}

/**
 * Return a string representation of the key
 *
 * @param key
 * @return formated string
 */
char* key_to_char(const t_key* key) {
    return key->full;
}

/**
 * Compare two keys
 *
 * @param key1
 * @param key2
 * @return 0 when keys are equal
 */
int key_cmp(const t_key* key1, const t_key* key2) {
    if (strcmp(key1->part1, key2->part1))
        return 1;
    else if (strcmp(key1->part2, key2->part2))
        return 1;
    else
        return 0;
}

/**
 * Delete a key
 *
 * @param key
 */
void key_delete(t_key* key) {
    if (!key)
        return;

    free(key->full);
    free(key);
}

/**
 * Initialize a record
 *
 * @param key
 * @param data
 * @return pointer to the record
 */
t_record* record_init(t_key* key, void* data) {
    t_record* r = malloc(sizeof(t_record));

    r->key = key;
    r->data = data;
    r->next = NULL;

    return r;
}

/**
 * Delete a record
 *
 * @param record
 * @param and_next remove linked records
 */
void record_delete(t_record* record, int and_next) {
    if (!record)
        return;

    /* Delete next record */
    if (and_next && record->next) {
        record_delete(record->next, and_next);
    }

    key_delete(record->key);
    free(record);
}

/************************************* Table functions*************************/

/**
 * Returns the index of a key
 *
 * @param table
 * @param key
 * @returns index of the key
 */
t_size table_index_of(const Table* table, t_key* key) {
    return table->hashfunction(key_to_char(key)) % table->length;
}

Table* table_init(const t_size length) {
    Table* t = malloc(sizeof(Table));
	
    t->records = malloc(sizeof(t_record*) * length);
    t->length = length;
	t->counter = 0;
    t->hashfunction = hash;
	
    return t;
}

void table_delete(Table* table) {
	t_size i = 0;
    if (!table)
        return;
	
    /* Delete records */
    for (i=0; i<table->length; i++) {
        record_delete(table->records[i], 1);
    }
	
	free(table->records);
    free(table);	
}

int table_insert(Table* table, char* key1, char* key2, void* data) {
    t_key* key = key_init(key1, key2);
    t_size index = table_index_of(table, key);
	t_record* new_r = NULL;

    /* Find and replace similar record */
    t_record* cursor = table->records[index];
    while (cursor) {
        if (!key_cmp(cursor->key, key)) {
            cursor->data = data;			/* Remplace with the new n-uplet */
            return 0;
        }
        cursor = cursor->next;
    }

    /* Insert a new record at the beginning of the list */
    new_r = record_init(key, data);
    new_r->next = table->records[index];
    table->records[index] = new_r;
	table->counter++;

    return 0;
}

int table_remove(Table* table, char* key1, char* key2) {
    t_key* key = key_init(key1, key2);
    t_size index = table_index_of(table, key);
    t_record* cursor = table->records[index];
    t_record* prev = NULL;

    while (cursor) {
        if (!key_cmp(cursor->key, key)) {		/* Found a match */
			/* Unlink the record */
            if (prev) {							/* not 1st element of the list */
                prev->next = cursor->next;
            } else {
                table->records[index] = cursor->next;
            }
			key_delete(key);
			table->counter--;
            return 0;
        }
        prev = cursor;
        cursor = cursor->next;
    }

	key_delete(key);							/* Not found */
	return -1;
}

t_size table_count(const Table* table) {
	return table->counter;
}

void* table_get(const Table* table, char *key1, char* key2) {
    t_key* key = key_init(key1, key2);
    t_size index = table_index_of(table, key);
    t_record* cursor = table->records[index];

    while (cursor) {
        if (!key_cmp(cursor->key, key)) {		/* Found ! */
            key_delete(key);
            return cursor->data;
        }

        cursor = cursor->next;
    }

    key_delete(key);							/* Not found */
    return NULL;
}

void table_print(const Table* table) {
    int count = 0;
    t_size i = 0;
	t_record* record = NULL;
	t_record* cursor = NULL;

    for (i=0; i<table->length; i++) {
         record = table->records[i];

        if (record) {
			/* Print index */
            printf("%ld : ", i);				

			/* Print all record (with collisions) */
            cursor = record;
            while (cursor) {
                printf("{'%s'= %s} ", key_to_char(cursor->key), (char*) cursor->data);
                count++;
                cursor = cursor->next;
            }
            printf("\n");
        }
    }

    printf("Total: %d records\n", count);
}