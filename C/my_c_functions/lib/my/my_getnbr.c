#include <unistd.h>
#include <stdio.h>

void my_putchar(char c);

int my_getnbr(const char *str)
{
    int i = 0;
    int res = 0;
    int count = 0;

    while(str[i] < '0' || str[i] > '9')
        {
            if (str[i] == '-')
                {
                    count = count + 1;
                }
            i = i + 1;
        }
    while(str[i] != '\0')
        {
            res = res + str[i]-48;
            if (str[i+1]>'0' && str[i+1]<'9')
                {
                    res=res*10;
                }
            i = i + 1;
        }
    if (count % 2 != 0)
        {
            res = res * (-1);
        }

    return(res);
}