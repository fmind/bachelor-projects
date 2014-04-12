# Tools
CC = gcc
LEX = flex

# Executable
EXEC = comments
all: $(EXEC)

# Suffixes
%.o: %.c
	$(CC) -o $@ -c $<

# Rules
comments: lex.yy.o main.o
	$(CC) lex.yy.o main.o -o comments

main.c: lex.yy.o

lex.yy.c: comments.l
	$(LEX) comments.l
	
clean: 
	rm -f lex.yy.* *.o $(EXEC)
