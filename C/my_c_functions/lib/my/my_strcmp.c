#include <unistd.h>

void my_putchar(char c);

int my_strcmp(const char *s1, const char *s2)
{
    int i = 0;

    while(s1[i] != '\0' && s2[i] != '\0' && s1[i] == s2[i])
        {
            i = i + 1;
        }
     return(s1[i] - s2[i]);
}