# Standard American Convention
# На вход программе подаётся натуральное число.
# Напишите программу, которая вставляет в заданное число запятые
# в соответствии со стандартным американским соглашением о запятых в больших числах.
n= input()[::-1]
s=''
while len(n) > 3:
    s += n[:3] + ','
    n = n[3:]
s += n
print(s[::-1])