#Compilateur C à utiliser
CC=gcc

#yacc ou bison
#YACC= bison -y --debug --verbose
YACC= bison -y

#lex ou flex
#LEX=flex -d
LEX=flex

#Executable
all: a.exe

#suffixes
%.o: %.c
	$(CC) -o $@ -c $<

y.tab.c: mini.y
	$(YACC) -d mini.y

a.exe:  lex.yy.o y.tab.o main.o
	$(CC) lex.yy.o y.tab.o main.o -o a.exe
	
lex.yy.c: mini.lex y.tab.c
	$(LEX) mini.lex
#raz
clean: 
	rm -f lex.yy.* y.tab.* *.o a.exe *.output
