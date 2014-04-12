#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  unsigned int n;
  int reste = 0;
  int resultat = 0;
  
  printf("n : ");
  scanf("%d", &n);
  
  while(n !=0)
  {
    reste = n % 10;
    resultat += reste;
    n /= 10;
  }
  
  printf("\nResultat : %d\n", resultat);
  
  return 0;
}

