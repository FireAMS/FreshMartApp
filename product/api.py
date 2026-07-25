import time
from flask import Flask
from flask_restful import Resource, Api
import psycopg2
import os

# create a flask object
app = Flask(__name__)
api = Api(app)

#database connection 

def get_db_connection():
    retries = 5
    while retries > 0:
        try:
            conn = psycopg2.connect(
                host=os.getenv('DB_HOST', 'db'),
                database=os.getenv('DB_NAME', 'freshmartdb'),
                user=os.getenv('DB_USER', 'admin'),
                password=os.getenv('DB_PASSWORD', 'mysecret')
            )
            return conn
        except psycopg2.OperationalError:
            retries -= 1
            time.sleep(2)
    raise Exception("Could not connect to database")

#Fruits display per name, category, season
# the accessors
class Fruits(Resource):
    def get(self):
        try:
            conn = get_db_connection()
            cur = conn.cursor()
            cur.execute('SELECT name, category, season FROM fruits;')
            rows = cur.fetchall()
            return {
                'fruits': [
                    {'name': row[0], 'category': row[1], 'season': row[2]}
                    for row in rows
                ]
            }
        except Exception as e:
            return {'error': str(e)}, 500

# adds the resources at the root route
api.add_resource(Fruits, '/')

# if this file is being executed then run the service
if __name__ == '__main__':
    # run the service
    app.run(host='0.0.0.0', port=80, debug=True)
