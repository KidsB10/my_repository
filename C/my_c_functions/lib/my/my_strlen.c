#include <unistd.h>

void my_putchar(char c);

int my_strlen(const char *str)
{
    int i = 0;

    while(str[i]!='\0')
    {
        i=i+1;
    }
    return (i);
}