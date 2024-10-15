import sys
import whois

if len(sys.argv) > 1:
    received_parameter = sys.argv[1]    
else:
    received_parameter = ''     
d = whois.whois(received_parameter)
print(d.text)
print('------------------------------------')
print(d)
#print(d.__dict__)