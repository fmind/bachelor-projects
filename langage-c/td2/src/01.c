#include <stdio.h>
#include <stdlib.h>

 int main(void)
{
  int a=3;
  int b=10;
  int c, *pa, *pb, *pc;
  pa = &a;
  *pa = *pa * 2;
  pb = &b;
  c = 3 * (*pb - *pa);
  pc = pb;
  pa = pb;
  pb = pc;
  
  printf("a %d\n", a);      // 6
  printf("b %d\n", b);      // 10
  printf("c %d\n", c);      // 12
  printf("*a %d\n", *pa);   // 10
  printf("*b %d\n", *pb);   // 10
}
