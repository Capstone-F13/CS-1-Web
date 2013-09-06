#include <stdio.h>
#include <sys/stat.h>  /* for mkfifo */
#include <sys/types.h>  /* for open */
#include <sys/stat.h>  /* for open */
#include <fcntl.h>    /* for open */
#include <unistd.h>   /* for write */
#include <stdlib.h>
#include <signal.h>
#define BUFFSIZE 8192
#define MaxPipeName 50
#define logdir "/tmp/debugger/"
#define numDbgArgs 3
#define ArgSize 30

pid_t child_pid;

void catch_sigpipe(int sig_num)
{
    /* re-set the signal handler again to catch_int, for next time */
    signal(SIGPIPE, catch_sigpipe);
    printf("got a si\n");
   fflush(stdout);
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
  argv[0]="/home/ruttan/Desktop/echo";
  argv[1]=0;  
}

int main (int argc, char ** argv) {
  int n;
  char * nargv[numDbgArgs];
  int fdtoWeb,fdfrmWeb,fdtoDbg,fdfrmDgb,pipefd[2];
  char buf[BUFFSIZE],line[BUFFSIZE],toServer[MaxPipeName],fromServer[MaxPipeName];
 
    signal(SIGPIPE, catch_sigpipe);
    if ((argc < 2 )|| (argc >=3)){
      perror("usage: debugger idcode");
      exit(1);
    }
    /*
    //create input pipe from webserver
    sprintf(fromServer,"%s%s%s",logdir,argv[1],"OUT");
    unlink(fromServer);
    
    if (-1 == mkfifo(fromServer,S_IRWXU)) {
       perror("Error, could not make fifo\n");
    }

    //create output pipe to webserver
    sprintf(toServer,"%s%s%s",logdir,argv[1],"IN");
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
  
    */ 
    int i;
    char c;make_args(argv[1],nargv);
      child_pid=launch_debugger(nargv,pipefd);
      printf("child_pid=%d\n",child_pid);
      fflush(stdout);

   

    //   while(1){
      /* 
      if ((n=read(fdfrmWeb,line,BUFFSIZE))){
        line[n]=0;
	n=sprintf(buf,"%d-%s%s",n,"debugger:",line);
         if (write(1,buf,n) != n) {
             printf("cp: write error on file stdout\n");
             fflush(stdout);
             exit(1);
	 }
         if (write(fdtoWeb,buf,n) != n) {
             perror("fdtoWeb write error");
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
      }
      */
    while (1){

      i=0;
      while ((c=getchar())!='\n'){
 	line[i++]=c;
      }
      line[i]=c;        
      write(pipefd[1],line,i+1);
      if ((n=read(pipefd[0],line,BUFFSIZE))){
         line[n]=0;
      } 
      printf("%s",line);
      fflush(stdout);
    }
exit(0);
}


