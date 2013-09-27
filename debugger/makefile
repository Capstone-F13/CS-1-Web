CC=gcc
OBJS=interface webserver2 pipetest

all: $(OBJS)

%: %.o
	$(CC) $< -o $@

%.o: %.c
	$(CC) -g $< -o %

clean:
	@rm -rf $(OBJS)
