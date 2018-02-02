from RestrictedPython import compile_restricted
from RestrictedPython.Guards import safe_builtins
import sys

print sys.argv[1]
f = open(sys.argv[1])
loc = {}
byte_code = compile_restricted(f.read(), '<inline code>', 'exec')
#print safe_builtins
exec(byte_code, {'_print_'})
