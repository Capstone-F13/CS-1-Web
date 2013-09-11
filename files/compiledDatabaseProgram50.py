import random
c1="""
import sys
import os
def recursive(a):
  if a == 1:
    return a+1
  else:
    return a + recursive(a-1)

print (recursive(_r0))
"""
random.seed()
c1=c1.replace("_r0",str(random.randint(3,8)))
print (c1)