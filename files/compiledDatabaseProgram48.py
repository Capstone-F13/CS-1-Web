import random
c1 = """
a=_r0
b=_r1
if (a == _r2):
print "0,2"
elif (b==_r2):
print "1,2"
else:
print "neither"
"""
random.seed()
c1=c1.replace("_r0",str(random.randint(1,3)))
c1=c1.replace("_r1",str(random.randint(1,3)))
c1=c1.replace("_r2",str(random.randint(1,3)))
print(c1)
