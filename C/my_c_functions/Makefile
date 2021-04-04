CC =    gcc
CFLAGS = -Wall -Wextra -Werror -L.
LDFLAGS = -lmy
NAME =  compilator
SRC =   my_crd.c        \
        my_getnbr.c     \
        my_putchar.c    \
        my_putstr.c     \
        my_strcpy.c     \
        my_strlen.c     \
        my_strncpy.c    \
        my_isneg.c      \
        my_putnbr.c     \
        my_strcmp.c     \
        my_strdup.c     \
        my_strncmp.c    \
        my_swap.c       \
        my_strcat.c     \
        my_strncat.c    \
        my_strstr.c
OBJ =   $(SRC:%.c=%.o)
RM =    rm -f

$(NAME):    $(OBJ)
            $(CC) $(OBJ) -o $(NAME) $(LDFLAGS)

all:        $(NAME)

clean:      $(RM) $(OBJ)

fclean:             clean
            $(RM) $(NAME)

re:         fclean all