#include <unistd.h>
#include <stdlib.h>

void my_putchar(char c);

char *my_strcpy(char *dest,const char *src)
{
    int i = 0;

    while(src[i]!='\0')
    {
        dest[i]=src[i];
        i=i+1;
    }
    dest[i]='\0';
    return(dest);
}

int my_strlen(const char *str)
{
    int i = 0;

    while(str[i]!='\0')
    {
        i=i+1;
    }
    return (i);
}

char *my_strdup(const char *src)
{
    char *i;
    i= malloc((my_strlen(src)+1)*sizeof (char));
    my_strcpy(i, src);
    return(i);
}