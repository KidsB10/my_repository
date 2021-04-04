#include <unistd.h>

int my_strlen(const char *str)
{
    int i = 0;

    while(str[i]!='\0')
    {
        i=i+1;
    }
    return (i);
}

char *my_strcat(char *dest, const char *src)
{
	int len;
	int i;

	len = my_strlen(dest);
	i = 0;
	while (src[i])
		dest[len + i] = src[i++];
	dest[len + i] = '\0';
	return (dest);
}