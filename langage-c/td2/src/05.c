#include <stdio.h>
#include <stdlib.h>
#include <math.h>

int equation(float a, float b,float c, int* n, int* x1, int* x2) {
  int delta = 0;
  
  delta = b*b - 4*a*c;
  
  printf("\n");
  
  if (delta > 0) {
    *n = 2;
    *x1 = (-b + sqrt(delta)) / 2*a;
    *x2 = (-b - sqrt(delta)) / 2*a;
  } else if (delta == 0) {
    *n = 1;
    *x1 = -b / 2*a;
    *x2 = *x1;
  } else {
    *n = 0;
  }
  
  return 1;
}

int main(void)
{
  float a=0, b=0, c=0;
  int n=0, x1=0, x2=0;
  
  printf("a : ");
  scanf("%f", &a);
  printf("b : ");
  scanf("%f", &b);
  printf("c : ");
  scanf("%f", &c);
  
  equation(a,b,c,&n,&x1,&x2);
  
  printf("Résultat");
  printf("\nn : %d", n);
  printf("\nx1 : %d", x1);
  printf("\nx2 : %d", x2);
  
  printf("\n");
  
  return 0;
}

