
#include <iostream>
#include <fstream>
#include <iomanip>
using namespace std;

int recursive(int a){
  if (a == 1)
      return a+3;
  else
    return a+recursive(a-1);
}

main(){
  cout << recursive(6)<<'\n';
}

