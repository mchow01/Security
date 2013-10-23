#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int check (char *str)
{
  char buf[16];
  int flag = 0;

  strcpy(buf, str);
  if (strcmp(buf, "blinky_the_wonder_chimp") == 0) {
    flag = 1;
  }
  return flag;
}

int main(int argc, char *argv[]) {
  if (argc < 2) {
    printf("Perhaps use your first name as an argument. :-)\n");
    return 1;
  }
  if (check(argv[1])) {
    printf("key{d21f5c37658648250bfbb22824a337174ced3161}\n");
  }
  else {
    printf("%s, you are doing a heckuvajob up to this point!\n", argv[1]);
  }
  return 0;
}
