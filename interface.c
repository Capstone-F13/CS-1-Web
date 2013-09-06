#include <stdio.h>
#include <sys/stat.h>  /* for mkfifo */
#include <sys/types.h>  /* for open */
#include <sys/stat.h>  /* for open */
#include <fcntl.h>    /* for open */
#include <unistd.h>   /* for write */
#include <stdlib.h>
#include <signal.h>
#include <string.h>
#define BUFFSIZE 8192
#define MaxPipeName 100
#define logdir "/home/ruttan/classes/capstone/debugger/"
#define numDbgArgs 5
#define ArgSize 30

pid_t child_pid;
char buf[BUFFSIZE];
FILE * fdtoFILE;

void catch_sigpipe(int sig_num)
{
    /* re-set the signal handler again to catch_int, for next time */
    signal(SIGPIPE, catch_sigpipe);
    fprintf(fdtoFILE,"got a signal\n");
    fflush(fdtoFILE);
}
void catch_sigint(int sig_num)
{
    /* re-set the signal handler again to catch_int, for next time */
    signal(SIGINT, catch_sigint);
    kill(child_pid,1); 
    fprintf(fdtoFILE,"got a sigint signal\n");
    fflush(fdtoFILE);
    sleep(1);
    exit(1);
}

pid_t launch_debugger(char * argv[],int pipefd[2]){
  int stdio[3];
  pid_t child_pid;
  int pipefd0[2],pipefd1[2];
  pipe(pipefd0);
  if(pipe(pipefd0) == -1) {
        perror("Pipe 0 creation failed");
        exit(1);
    }
  pipe(pipefd1);
  if(pipe(pipefd1) == -1) {
        perror("Pipe 1 creation failed");
        exit(1);
  }
  //create function to setup pipes fork and exec
  pipefd[0]=pipefd0[0];
  pipefd[1]=pipefd1[1];
  stdio[0]=dup(STDIN_FILENO);   
  stdio[1]=dup(STDOUT_FILENO);
  stdio[2]=dup(STDERR_FILENO);
  dup2(pipefd1[0],STDIN_FILENO);    
  dup2(pipefd0[1],STDOUT_FILENO);    
  dup2(pipefd0[1],STDERR_FILENO);
  switch (child_pid=fork()){
  case -1:
     perror("Could not fork debugger");
     exit(1);
     break;
  case 0:
    if (execvp(argv[0],argv)==-1){
      perror("exec failed");
      exit(1);
    }
  default:
    //after fork in parent.
    dup2(stdio[0],STDIN_FILENO);    
    dup2(stdio[1],STDOUT_FILENO);    
    dup2(stdio[2],STDERR_FILENO);
    close(pipefd1[0]);
    close(pipefd0[1]);
  }
  return(child_pid);   
}

void make_args(char * id,char * argv[]){
  argv[0]="/usr/bin/python";
  argv[1]="-i";
  argv[2]="-c";
  argv[3]="\"print 'Starting'\"";
  argv[4]=0;  
}

int main (int argc, char ** argv) {
  int n;
  char * nargv[numDbgArgs];
  int fdtoWeb,fdfrmWeb,fdtoDbg,fdfrmDgb,pipefd[2];
  char line[BUFFSIZE],toServer[MaxPipeName],fromServer[MaxPipeName];
    sprintf(buf,"%s%s%s",logdir,"FILE",argv[1]);
    unlink(buf);
    fdtoFILE=fopen(buf,"w");
    fprintf(fdtoFILE,"testing file output\n");

    signal(SIGPIPE, catch_sigpipe);
    signal(SIGINT, catch_sigint);
    if ((argc < 2 )|| (argc >=3)){
      perror("usage: debugger idcode");
      exit(1);
    }
    //create input pipe from webserver
    sprintf(fromServer,"%s%s%s",logdir,"OUT",argv[1]);
    unlink(fromServer);
    
    if (-1 == mkfifo(fromServer,S_IRWXU)) {
       perror("Error, could not make fifo\n");
    }

    //create output pipe to webserver
    sprintf(toServer,"%s%s%s",logdir,"IN",argv[1]);
    unlink(toServer);
    
    if (-1 == mkfifo(toServer,S_IRWXU)) {
        perror("Error, could not make fifo\n");
    }
    if ((fdfrmWeb = open(fromServer,O_RDONLY)) == -1) {
      perror("cannot open fifo from server");
      exit(1);
    }
    if ((fdtoWeb = open(toServer,O_WRONLY)) == -1) {
      perror("cannot open fifo to server");
      exit(1);
    }
    //create pipes to debugger
   
    if(pipe(pipefd) == -1) { //perhaps pipe(pipefd,O_NONBLOCK)
        perror("Pipe 1 creation failed");
        exit(1);
    }
  
    int i;
    char c;
      make_args(argv[1],nargv);
      child_pid=launch_debugger(nargv,pipefd);
      fprintf(fdtoFILE,"child_pid=%d\n",child_pid);
      fflush(fdtoFILE);
       setpgid(0, 0);
      fprintf(fdtoFILE,"---starting---\n");
      fflush(fdtoFILE);
        

      while(1){
        line[0]=0;
        while (!strstr(line,">>>") && !strstr(line,"...")){
          if ((n=read(pipefd[0],line,BUFFSIZE))){
            if (!n) {
              fprintf(fdtoFILE,"pipe fd[0] closed");
              fflush(fdtoFILE);
              exit(1);
	    }
            //line[n++]='@'; 
            line[n]=0;
	    //if n=BUFFSIZE...
           }       
          fprintf(fdtoFILE,"p-%s",line);
          fflush(fdtoFILE);
          if (write(fdtoWeb,line,n) != n) {
             perror("fdtoWeb write error");
            fprintf(fdtoFILE,"fdtoWeb write error\n");
            fflush(fdtoFILE);

	  }         

        }
 
         if ((n=read(fdfrmWeb,line,BUFFSIZE))){
            line[n]=0;
            fprintf(fdtoFILE,"%d-%s%s",n,"w-",line);
	    fflush(fdtoFILE);
             if (write(pipefd[1],line,n) != n) {
             perror("pipefd[1] write error");
	     }        

	 }
         else{
           printf("empty read\n");
	   close(fdtoWeb);
           close(fdfrmWeb);
           n=0;
           if ((fdfrmWeb = open(fromServer,O_RDONLY)) == -1) {
              perror("cannot open fifo from server");
              exit(1);
           }
    
           if ((fdtoWeb = open(toServer,O_WRONLY)) == -1) {
             perror("cannot open fifo to server");
             exit(1);
	   }
           line[0]='\n';
           if (write(pipefd[1],line,1) != 1) {
             perror("pipefd[1] write error");
	   }        

	 }

      }
   
    exit(0);
}


