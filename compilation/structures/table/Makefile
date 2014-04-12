CC = gcc
CFLAGS = -W -Wall -ansi -pedantic
INCFLAGS = 
LDFLAGS = -Wl,-rpath,/usr/local/lib
SRC= $(wildcard *.c)
OBJ= $(SRC:.c=.o)
LIBS = 
EXEC= test_table

all: tp1 clean

tp1: $(OBJ)
	$(CC) -o $(EXEC) $(OBJ) $(LDFLAGS) $(LIBS)

.SUFFIXES:
.SUFFIXES:	.c .cc .C .cpp .o

.c.o :
	$(CC) -o $@ -c $(CFLAGS) $< $(INCFLAGS)

count:
	wc *.c *.h

clean:
	rm -f *.o

.PHONY: all
.PHONY: count
.PHONY: clean
