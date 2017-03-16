CBTRACKER
===============================

Tool developed with:

Server:
*Python
*MySql

Client:
*Yii2 (PHP Framework)
*Materialize CSS


Installation:

1)
Restore database (MySql) from folder backup-base-de-datos

DataBase Name: yii2advanced2

2)
Create a twitter account and create a twitter app

From folder servidor config variables on file Tweepy.py

consumer_key = '####'  --->>>> twitter app (https://apps.twitter.com/)
consumer_secret = '####'  --->>>> twitter app (https://apps.twitter.com/)
access_token = '####'  --->>>> twitter app (https://apps.twitter.com/)
access_secret = '####'  --->>>> twitter app (https://apps.twitter.com/)

3)
run script:

python Tweepy.py

4)
send tweet to a created account with words used on cyberbullying (you can add words used on cyberbullying in your city, file diccionario.txt), example:

@new_user_twitter eres un baboso

(baboso exists on diccionario.txt and the tool detected cyberbullying)






