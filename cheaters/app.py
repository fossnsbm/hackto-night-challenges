from flask import Flask,request,send_file,render_template,redirect
import sys
import time
import gunicorn
import uvicorn
import sqlite3
import json

print("Server is Running ...")

u_json = open('config.json')
u_data = json.load(u_json)

# print(u_data['UID'])

db= sqlite3.connect('sqlite.db', check_same_thread=False) 
cursor = db.cursor()
table_query = '''CREATE TABLE Users (uid, uname, email, password)'''
try:
    cursor.execute(table_query)
    db.commit()
    db.close()
except:
    pass  

table_query_fd = '''CREATE TABLE Feed (itemID, uname, feedback)'''
try:
    cursor.execute(table_query_fd)
    db.commit()
    db.close()
except:
    pass  


app = Flask(__name__)

@app.before_first_request
def initialize():
    print("Initializing...")

@app.route("/")
def hbb():
    info = {"stats":"Running","Owned by":"HBB Company Pvt Ltd"}
    return info

@app.route("/register", methods=['GET','POST'])
def adduser():
    username = request.args.get('uname')
    email = request.args.get('email')
    password = request.args.get('password')
    uid = int(u_data['UID']) + 1
    sample = {"UID":uid}
    with open('config.json', 'w') as fp:
        json.dump(sample, fp)
    fp.close()

    q=f"INSERT INTO Users VALUES ('{str(uid)},{username}','{email}','{password}')"
    cursor.execute(q)
    db.commit()
    return {"UID":uid,"username":username, "email":email, "password":password,"status":"Recorded Sucessfully"}


@app.route("/all_users", methods=['GET','POST'])
def all_usrs():
    list = []
    que = "select * from Users"
    usr_data = cursor.execute(que)
    for data in usr_data:
        list.append(data)
    return list
    
@app.route("/login", methods=['GET','POST'])
def log():
    list  = []
    email = request.args.get('email')
    password = request.args.get('password')
    que = f"select uname from Users where email='{email}' and password='{password}'"
    usr = cursor.execute(que)
    for data in usr:
        list.append(data)
    if len(list) == 0:
        status = "Invalid Login !"
    else:
        status = "Sucessful Login !"
    return status

@app.route("/remove_user", methods=['GET','POST'])
def remusr():
    email = request.args.get('email')
    password = request.args.get('password')
    que = f"DELETE FROM Users WHERE email='{email}'"
    try:
        usr = cursor.execute(que)
        db.commit()
        status = "User removed !"
    except:
        status = "User Not Found !"
    return status


@app.route("/feedback", methods=['GET','POST'])
def user_feed():
    itemid = request.args.get("itemid")
    username = request.args.get("username")
    feedback = request.args.get("feedback")
    que = f"INSERT INTO Feed VALUES ('{itemid}','{username}','{feedback}')"
    try:
        usr = cursor.execute(que)
        db.commit()
        status = "Feedback added"
    except:
        status = "Error !"
    return status

@app.route("/list_feedback", methods=['GET','POST'])
def all_feed():
    list = []
    que = "Select * from Feed"
    usr = cursor.execute(que)
    for data in usr:
        list.append(data)
    return list



if __name__  == "__main__":
    app.run(threaded=True, port=5200, debug=True)