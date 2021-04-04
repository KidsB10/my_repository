#include <unistd.h>

void my_putchar(char c);

void my_putnbr(int n)
{
    int reste = 0;

    if(n < 0)
    {
        my_putchar('-');
        n = n *(-1);
    }

    if(n >= 10)
    {
        reste = n % 10;
        my_putnbr(n / 10);
        my_putchar(reste + '0');
    }

    if(n <= 9 && n >= 0)
    {
        my_putchar(n + '0');
    }

}