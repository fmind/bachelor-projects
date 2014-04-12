OBJS = arbre.o test_table.o
CC = gcc
CFLAGS = -Wall -ansi -g

test_table.exe : arbre.o test_table.o
	$(CC) $(OBJS) -o test_table.exe

arbre.o : arbre.c
	$(CC) $(CFLAGS) -c arbre.c -o arbre.o

test_table.o : test_table.c
	$(CC) $(CFLAGS) -c test_table.c -o test_table.o

clean:
	rm *.o *.exe*
