#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  int a = 0, b = 0;
  int i = 1, j = 1;
  
  printf("a : ");
  scanf("%d", &a);
  printf("b : ");
  scanf("%d", &b);
  
  if (b < a)
  {
    int c = b;
    b = a;
    a = c;
  }
  
  for (i; i < a; i++)
  {
    for (j=1; j < b; j++)
    {
      printf("%d %d\n", i*b, j*a);
      if (i*b == j*a)
      {
        printf("Résultat : %d\n", j*a);
        exit(0);
      }
    }
  }
  
  printf("Résultat : %d\n", a*b);
  
  return 0;
}

