#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  float a=0, b=0, c=0;
  float delta = 0;
  
  printf("a : ");
  scanf("%f", &a);
  printf("b : ");
  scanf("%f", &b);
  printf("c : ");
  scanf("%f", &c);
  
  delta = b*b - 4*a*c;
  printf("Delta : %f", delta);
  
  if (delta > 0)
  {
    printf("\n2 solution dans R");
  }
  else if (delta == 0)
  {
    printf("\n1 solution dans R");
  }
  else
  {
    printf("\nPas de solution réelle");
  }
  
  printf("\n");
  
  return 0;
}

