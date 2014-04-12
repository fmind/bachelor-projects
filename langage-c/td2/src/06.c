#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int palindrome(char * str) {
  int i=0, j=strlen(str);
  
  for (i; i < j; i++, j--) {
    if (str[i] != str[j-1]) return 0;
  }
  
  return 1;
}


int main(void) {
  char* str;
  
  printf("Palindrome bonjour : %d\n", palindrome("bonjour"));
  printf("Palindrome abba : %d\n", palindrome("abba"));
  printf("Palindrome ababa : %d\n", palindrome("ababa"));
  
  return 0;
}

