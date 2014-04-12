#Compilateur C � utiliser
CC=gcc
CFLAGS = -Wall -ansi -g

#yacc ou bison
#YACC= bison -y --debug --verbose
YACC= bison -y

#lex ou flex
#LEX=flex -d
LEX=flex

#Executable
all: compilateur.exe

#suffixes
%.o: %.c
	$(CC) -o $@ -c $<

y.tab.c: mini.y
	$(YACC) -d mini.y

compilateur.exe:  lex.yy.o y.tab.o table.o arbre.o main.o
	$(CC) $(CFLAGS)  *.o -o compilateur.exe
	
lex.yy.c: mini.lex y.tab.c
	$(LEX) mini.lex
#raz
clean: 
	rm -f lex.yy.* y.tab.* *.o compilateur.exe *.output
