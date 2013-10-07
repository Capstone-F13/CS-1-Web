#include <stdio.h>
#include <sys/stat.h>  /* for mkfifo */
#include <sys/types.h>  /* for open */
#include <sys/stat.h>  /* for open */
#include <fcntl.h>    /* for open */
#include <unistd.h>   /* for write */
#include <stdlib.h>
#include <errno.h>
#include <string.h>
#include <signal.h>
#define BUFFSIZE 8192
#define MaxPipeName 100
<<<<<<< HEAD
#define logdir "/var/www/html/Web/debugger/"
#define interface "interface"
=======
#define logdir "log/"
#define interface "./interface"
>>>>>>> master
#define numDbgArgs 5

pid_t child_pid;
void catch_sigint(int sig_num)
{
    /* re-set the signal handler again to catch_int, for next time */
    printf("got signal sigint\n");
    fflush(stdout);
    signal(SIGINT, catch_sigint);
    kill(child_pid,SIGINT); 
    exit(1);
}

void make_args(char * id,char * argv[]){
    char *prog = interface;
    /*prog=(char *)malloc(MaxPipeName);*/
    /*sprintf(prog,"%s%s",logdir,interface);*/
    argv[0]=prog;
    argv[1]=id;
    argv[2]=0;  
}

pid_t launch_interface(char * argv[]){
    int stdio[3];
    pid_t child_pidt;
    usleep(10000);
    switch (child_pidt=fork()){
        case -1:
            perror("Could not fork debugger");
            exit(1);
            break;
        case 0:
            if (execvp(argv[0],argv)==-1){
                perror("exec failed");
                printf("exec =%s",argv[0]);
                fflush(stdout);
                exit(1);
            }
            //after fork in parent
    }
    /*free(argv[0]);*/
    return(child_pidt);   
}

main (int argc,char** argv ) {
    int fd,i;    
    int len,n;
    char line[BUFFSIZE];
    char c;
    char * nargv[numDbgArgs];
    int fdtoDbg,fdfrmDbg,fileCheckO,fileCheckI,errnoO,errnoI;
    struct stat stat_bufO, stat_bufI;
    char buf[BUFFSIZE],toDebugger[MaxPipeName],fromDebugger[MaxPipeName];
    if ((argc < 2 )|| (argc >=3)){
        perror("usage: webserver idcode");
        exit(1);
    }
    signal(SIGINT, catch_sigint);   
    sprintf(toDebugger,"%s%s%s",logdir,"OUT",argv[1]);
    sprintf(fromDebugger,"%s%s%s",logdir,"IN",argv[1]);
    fileCheckO=stat(toDebugger,&stat_bufO);
    errnoO=errno;
    fileCheckI=stat(fromDebugger,&stat_bufI); 
    errnoI=errno;

    if ((fileCheckO == -1) && (fileCheckI == -1)) {
        if ((errnoO==2) && (errnoI==2)){
            printf("NEITHER files exists\n");
            fflush(stdout);
            make_args(argv[1],nargv);
            child_pid=launch_interface(nargv);
            usleep(10000);
        }
        else{
            printf("errnoI=%s\n",strerror(errnoI));
            printf("errnoO=%s\n",strerror(errnoO));
            fflush(stdout);
            exit(0);
        }

    } else {
        if ((errnoO == 0) && (errnoI == 0) &&
                S_ISFIFO(stat_bufO.st_mode) && S_ISFIFO(stat_bufI.st_mode)){
            printf("both files are FIFOs\n");
            fflush(stdout);
        }
        else{
            printf("files exist in impossible state--correcting\n");
            if (!fileCheckO) unlink(toDebugger);
            if (!fileCheckI) unlink(fromDebugger);
            fflush(stdout);
            make_args(argv[1],nargv);
            child_pid=launch_interface(nargv);
            usleep(10000);
        }
    }


    //create output pipe to webserver


    if ((fdtoDbg = open(toDebugger,O_WRONLY)) == -1) {
        perror("cannot open fifo to debugger");
        exit(1);
    }
    //create input pipe from webserver
    if ((fdfrmDbg = open(fromDebugger,O_RDONLY)) == -1) {
        perror("cannot open fifo from debugger");
        exit(1);
    }

    while(1) {
<<<<<<< HEAD
      line[0]=0;
      while (!strstr(line,">>>")&& !strstr(line,"...")  ){
        if ((n=read(fdfrmDbg,line,BUFFSIZE))){
           line[n]=0;
           printf(":%d-web:%s",n,line);
           fflush(stdout);
        }
        else{
          printf("null read on fdfrmDbg\n");
          fflush(stdout);
	  exit(1);
        }
      } 
      i=0;
      while ((c=getchar())!='\n'){
	line[i++]=c;
        if (c == '#')
          exit(0);
      }
      line[i]=c;
      if  (strstr(line,"#123")){
        printf("webserver2 exiting\n");
        fflush(stdout);
        break;    
      } 
      write(fdtoDbg,line,i+1);
=======
        line[0]=0;
        while (!strstr(line,">>>")&& !strstr(line,"...")  ){
            if ((n=read(fdfrmDbg,line,BUFFSIZE))){
                line[n]=0;
                printf("%d-web:%s",n,line);
                fflush(stdout);
            }
            else{
                printf("null read on fdfrmDbg\n");
                fflush(stdout);
                exit(1);
            }
        } 
        i=0;
        while ((c=getchar())!='\n'){
            line[i++]=c;
        }
        line[i]=c;
        if  (strstr(line,"#123")){
            printf("webserver2 exiting\n");
            fflush(stdout);
            break;    
        } 
        write(fdtoDbg,line,i+1);
>>>>>>> master
    }  
    exit(0);
}
