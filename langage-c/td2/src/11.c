#include <stdio.h>
#include <stdlib.h>

void decoupure(int solde) {
  int i=0, j=0;
  int coupure[] = {500, 200, 100, 50, 20, 10, 5, 2, 1};
  int peut_couper = 1;
  
  for (i; i<9; i++) {
    while (peut_couper) {
      if (solde - coupure[i] >= 0) {
        solde -= coupure[i];
        printf("%d ", coupure[i]);
      } else {
        peut_couper = 0;
      }
    }
    peut_couper = 1;
  }
}

int main(void) {
  printf("\nDécoupure 1250\n");
  decoupure(1250);
  printf("\nDécoupure 666\n");
  decoupure(666);
  printf("\nDécoupure 389\n");
  decoupure(389);
  
  printf("\n");
  
  return 0;
}

