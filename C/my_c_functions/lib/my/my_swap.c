#include <unistd.h>

void my_putchar(char c);

void my_swap(int *a, int *b)
{
    char tmp;

    tmp=*b;
    *b=*a;
    *a=tmp;
}