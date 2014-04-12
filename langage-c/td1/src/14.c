#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  int i = 0, j = 0, n = 0;
  
  printf("n : ");
  scanf("%d", &n);
  
  for (i; i <= n; i++)
  {
    for (j=i; j > 0; j--)
    {
      printf("*");
    }
    printf("\n");
  }
  
  printf("\n");
  
  return 0;
}

