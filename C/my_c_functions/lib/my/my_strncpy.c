#include <unistd.h>

void my_putchar(char c);

void my_putstr(const char *str)
{
    int i=0;

    while  (str[i] != '\0')
    {
        my_putchar(str[i]);
        i=i+1;
    }
}

char *my_strncpy(char *dest,const char *src, int n)
{
    int i = 0;

    while(src[i]!='\0' && i < n)
    {

        dest[i]=src[i];
        i=i+1;
    }
    dest[i]='\0';
    return(dest);
}