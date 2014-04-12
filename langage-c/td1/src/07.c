#include <stdio.h>
#include <stdlib.h>

int main(void)
{
  int a=0, b=0, c=0;
  
  printf("Taper 3 valeurs séparez par le caractère 'Entrer':\n");
  scanf("%d", &a);
  scanf("%d", &b);
  scanf("%d", &c);
  
  a = (b>a) ? b : a;
  a = (c>a) ? c : a;
  
  printf("Plus grande valeur: %d \n", a);
  
  return 0;
}

