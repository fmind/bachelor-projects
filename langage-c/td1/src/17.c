#include <stdio.h>
#include <stdlib.h>

int nbsum(unsigned int n)
{
  int i = 0;
  int j = 0;
  
  printf("%d = %d\n", n, n);
  
  for (i=n-1; i>0; i--)
  {
    j = n-i;
    
    if (i>j && j != 1) printf("%d = %d + %d\n", n, i, j);
    
    printf("%d = %i", n, i);
    for (j; j>0; j--)
    {
      printf(" + 1");
    }
    printf("\n");
  }
}

int main(void)
{
  unsigned int n = 0;
  
  printf("n : ");
  scanf("%d", &n);
  
  nbsum(n);
  
  return 0;
}

