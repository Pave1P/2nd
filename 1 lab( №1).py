a,b,c=int(input()),int(input()),int(input())
k=4
s=set()
s.add(a),s.add(b),s.add(c)
if len(s)==3:
    print(0)
else:
    print(k-len(s))