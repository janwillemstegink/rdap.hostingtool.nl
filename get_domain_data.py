import sys
import whois #python-whois installed and port 43 open

if len(sys.argv) > 1:
    received_parameter = sys.argv[1]    
else:
    received_parameter = ''     
w = whois.whois(received_parameter)
print(w.text)
print('------------------------------------')
print(w)
#print('------------------------------------')
#print(w.__dict__)
