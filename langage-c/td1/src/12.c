#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  int n = 0;
  int to_hex = 0;
  
  printf("0 pour conversion en hex, 1 pour conversion en déc : ");
  scanf("%d", &to_hex);
  
  if (to_hex)
  {
    printf("n : ");
    scanf("%X", &n);
    printf("Résultat en hexa : %d\n", n);
  }
  else
  {
    printf("n : ");
    scanf("%d", &n);
    printf("Résultat en hexa : %x\n", n);
  }
  
  return 0;
}

