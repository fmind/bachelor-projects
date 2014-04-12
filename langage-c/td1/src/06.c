#include <stdio.h>
#include <stdlib.h>

int factorielle(int n)
{
  if (n > 1) return n * factorielle(n - 1);
  else return 1;
}
  
int main(void)
{
  printf("\n%d\n", factorielle(5));
  return 0;
}

