#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  int n=0, i=1;
  
  printf("n: ");
  scanf("%d", &n);
  
  for (i; i <= n; i++)
  {
    printf("\n%d : %f", i, 1.0/i);
  }
  
  printf("\n");
  
  return 0;
}

