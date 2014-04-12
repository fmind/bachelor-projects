#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  int x=0, n=0;
  int i=1;
  
  printf("x: ");
  scanf("%d", &x);
  printf("n: ");
  scanf("%d", &n);
  
  printf("\nx=%d, n=%d", x, n);
  
  for (i; i < n; i++)
  {
    x *= x;
  }
  
  printf("\nRésultat: %d\n", x);
  
  return 0;
}

