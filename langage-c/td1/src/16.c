#include <stdio.h>
#include <stdlib.h>

int prime(unsigned int n)
{
  int i = 2;
  
  for (i; i < n ; i++)
  {
    if (n%i == 0) return 0;
  }
  
  return 1;
}

int main(void)
{
  unsigned int n = 0;
  
  printf("n : ");
  scanf("%d", &n);
  
  if (prime(n))
  {
    printf("%d est un nombre premier", n);
  }
  else
  {
    printf("%d n'est pas un nombre premier", n);
  }
  
  printf("\n");
  
  return 0;
}

