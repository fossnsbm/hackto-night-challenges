#!/bin/python3

import os

print('''

[?] what is the backend language you are commfortable with ? [ please select from given the options ]

[1]. php
[2]. python
[3]. nodejs

''')

lang=int(input("[>] enter options : "))
print("[+] you selected : ",lang)
os.system("mkdir backend")

if lang==1:
	cont='''FROM php:7.0-apache
	COPY ./var/www/php
	EXPOSE 5000
	'''
	with open("backend/Dockerfile","w") as f:
		f.write(cont)
	print("\n[!] process complete")

elif lang==2:
	cont='''FROM python:3-alpine
WORKDIR /backend
COPY requirements.txt ./
RUN pip install -r requirements.txt
COPY . .
EXPOSE 5000
CMD [ 'flask', 'run','--host','0.0.0.0','--port','5000']'''
	with open("backend/Dockerfile","w") as f:
		f.write(cont)
	print("\n[!] process complete")

elif lang==3:
	cont='''FROM node:16
COPY package.json package-lock.json $HOME/node_docker/
WORKDIR .
RUN npm install --silent --progress=false
EXPOSE 5000
CMD ["npm", "start"]'''
	with open("backend/Dockerfile","w") as f:
		f.write(cont)
	print("\n[!] process complete")
else:
	print("\n[!] process failed")
	print("[!] Please select a valid language.\nIf you cant develop with given options, please contact your mentor!")

