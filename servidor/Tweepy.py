import json
import tweepy
import datetime, time
import MySQLdb
from tweepy import OAuthHandler
from tweepy import Stream
from tweepy.streaming import StreamListener
 
consumer_key = '####'
consumer_secret = '####'
access_token = '####'
access_secret = '####'

auth = OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_secret)

api = tweepy.API(auth)

db = MySQLdb.connect(host="127.0.0.1",    # your host, usually localhost

                     user="root",         # your username

                     passwd="",  # your password

                     db="yii2advanced2")        # name of the data base



# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Definiciones

def process_or_store(tweet):
    print(json.dumps(tweet))

####################################################

d = open("diccionario.txt", "r")

diccionario = d.read().splitlines()

d.close()



def analizaFrase(frase):

	palabras = frase.split()

	for indice in range(0,len(palabras)):
		palabras[indice] = ''.join(caracter for caracter in palabras[indice] if caracter.isalnum()).lower()

	print(palabras)

	for palabra in palabras:
		if palabra in diccionario:
			print("'%s' es una frase malsonante" % (frase))
			return True
	return False

def guardarDatosMalos(tweet):

	if len(tweet['entities']['user_mentions']) == 1:
		query = "INSERT INTO mensaje (contenido,fechaevaluacion,estado,idusuario,idusuariodestino) VALUES ('%s','%s','%i','%i','%i')" % (tweet['text'],tweet['created_at'],1,int(tweet['id']),int(tweet['entities']['user_mentions'][0]['id']))
		cur.execute(query)
		db.commit()
	else:
		query = "INSERT INTO mensaje (contenido,fechaevaluacion,estado,idusuario) VALUES ('%s','%s','%i','%i')" % (tweet['text'],tweet['created_at'],1,int(tweet['id']))
		cur.execute(query)
		db.commit()

	print("### MENSAJE MALO INSERTADO : %s ###" % tweet['text'])

	test = api.get_user(screen_name=tweet['user']['screen_name'])
	query = "INSERT INTO usuario (nombre,foto,localizacion,fechacreacion) VALUES ('%s','%s','%s','%s')" % (tweet['user']['screen_name'],tweet['user']['profile_image_url_https'],test.location,test.created_at)
	cur.execute(query)
	db.commit()

	print("### USUARIO MALO INSERTADO : %s ###" % tweet['user']['screen_name'])

def guardarDatosBuenos(tweet):
	query = "INSERT INTO mensaje (contenido,fechaevaluacion,estado,idusuario) VALUES ('%s','%s','%i','%i')" % (tweet['text'],tweet['created_at'],0,int(tweet['id']))
	cur.execute(query)
	db.commit()

	print("### MENSAJE BUENO INSERTADO : %s ###" % tweet['text'])

	test = api.get_user(screen_name=tweet['user']['screen_name'])
	query = "INSERT INTO usuario (nombre,foto,localizacion,fechacreacion) VALUES ('%s','%s','%s','%s')" % (tweet['user']['screen_name'],tweet['user']['profile_image_url_https'],test.location,test.created_at)
	cur.execute(query)
	db.commit()

	print("### USUARIO BUENO INSERTADO : %s ###" % tweet['user']['screen_name'])

	

####################################################

def json_load_byteified(file_handle):
    return _byteify(
        json.load(file_handle, object_hook=_byteify),
        ignore_dicts=True
    )



def json_loads_byteified(json_text):
    return _byteify(
        json.loads(json_text, object_hook=_byteify),
        ignore_dicts=True
    )



def _byteify(data, ignore_dicts = False):
    # if this is a unicode string, return its string representation
    if isinstance(data, unicode):
        return data.encode('utf-8')
    # if this is a list of values, return list of byteified values
    if isinstance(data, list):
        return [ _byteify(item, ignore_dicts=True) for item in data ]
    # if this is a dictionary, return dictionary of byteified keys and values
    # but only if we haven't already byteified it
    if isinstance(data, dict) and not ignore_dicts:
        return {
            _byteify(key, ignore_dicts=True): _byteify(value, ignore_dicts=True)
            for key, value in data.iteritems()
        }
    # if it's anything else, return it in its original form
    return data



###################################################





while 1:
	for status in tweepy.Cursor(api.home_timeline).items(10):
		# Process a single status
		print(status.text)



	for friend in tweepy.Cursor(api.friends).items():
	    process_or_store(friend._json)



	for tweet in tweepy.Cursor(api.user_timeline).items():
		process_or_store(tweet._json)



	# Streaming 





	class MyListener(StreamListener):
		def on_data(self, data):
			try:
				with open('python.json', 'a+') as f:
					f.write(data)
					#data = data.replace("\"", "\'")
					tweet = json_loads_byteified(data)
					if analizaFrase(tweet['text']):
						guardarDatosMalos(tweet)
					elif not analizaFrase(tweet['text']):
						guardarDatosBuenos(tweet)
					return True
			except BaseException as e:
				print("Error on_data: %s" % str(e))
				return True

	 

		def on_error(self, status):
			print(status)
			return True

	twitter_stream = Stream(auth, MyListener())
	twitter_stream.filter(track=['@CB_HackForGood'])
