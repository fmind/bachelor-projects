#include <stdio.h>
#include <stdlib.h>

int f1(int i) { return i+1; }
int f2(int i) { return i++; }
int f3(int i) { printf("%d\n",i==0); return i; }
int f4(int i) { printf("%d\n",i=0); return i; }
int f5(int *i){ return ++(*i); }
int f6(int *i){ (*i)++; return (*i)++; }

int main(void){
  int a,b;
  a=f1(0);
  b=f2(1);
  printf("a=%d, b=%d\n",a,b);   // => a=1, b=1
  a=f3(a);                      // => 0
  b=f4(a);                      // => 0
  printf("a=%d, b=%d\n",a,b);   // => a=1, b=0
  a=f5(&a);
  b=f6(&a);
  printf("a=%d, b=%d\n",a,b);   // => a=4, b=3
}

