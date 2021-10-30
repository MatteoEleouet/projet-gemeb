# coding: utf-8
import smtplib
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText
from argparse import ArgumentParser

recipients=open("register.csv")
msg = MIMEMultipart()
msg['From'] = 'gemebsupplcr@gmail.com'
msg['To'] =recipients.read()
msg['Subject'] = 'Le sujet de mon mail' 
message = 'metteobg !'
msg.attach(MIMEText(message))
mailserver = smtplib.SMTP('smtp.gmail.com', 587)
mailserver.ehlo()
mailserver.starttls()
mailserver.ehlo()
mailserver.login('gemebsupplcr@gmail.com', 'willy9105')
mailserver.sendmail('gemebsupplcr@gmail.com',"gemebsupplcr@gmail.com", msg.as_string())
mailserver.quit()


