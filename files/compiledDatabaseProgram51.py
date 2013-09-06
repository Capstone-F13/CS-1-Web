import random
c1="""
#include <iostream>
#include <fstream>
#include <iomanip>
using namespace std;

int recursive(int a){
  if (a == 1)
      return a+_r0;
  else
    return a+recursive(a-1);
}

main(){
  cout << recursive(_r1)<<'\\n';
}
"""
random.seed()
c1=c1.replace("_r0",str(random.randint(3,8)))
c1=c1.replace("_r1",str(random.randint(5,10)))
print (c1)