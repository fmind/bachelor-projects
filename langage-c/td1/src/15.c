#include <stdio.h>
#include <stdlib.h>

int fibbo_iter(int n)
{
  int fn = 0, fn1 = 1;
  int i = 1;
  
  for (i; i <= n; i++)
  {
    fn = fn + fn1;
    fn1 = fn - fn1;
  }
  
  return fn;
}

int fibbo_rec(int n, int fn1, int fn)
{
  if (n == 0)
    return fn;
  else
    return fibbo_rec(n-1, fn, fn+fn1);
}

int main(void)
{
  int n = 0;
  
  printf("n : ");
  scanf("%d", &n);
  
  printf("Résultat(itératif) : %d", fibbo_iter(n));
  printf("\nRésultat(récursif) : %d", fibbo_rec(n,1,0));
  
  printf("\n");
  
  return 0;
}

