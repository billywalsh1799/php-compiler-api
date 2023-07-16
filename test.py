import sys
print("hello from python")
args=sys.argv
#print("arg1:",args[1],"arg2:",args[2])
print("all arguments:",args)

# Read the input from stdin
input_data = sys.stdin.readline().strip()

# Split the input using the delimiter
arguments = input_data.split("|")
for i in range(1,1000000000):
    print("all stdin pipe arguments:",arguments)
