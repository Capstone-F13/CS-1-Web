
import sys
import os
def recursive(a):
  if a == 1:
    return a+1
  else:
    return a + recursive(a-1)

print (recursive(8))

