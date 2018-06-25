from bottle import route, run, post, get, hook, response, request
import matplotlib.pyplot as plt
from matplotlib.backends.backend_agg import FigureCanvasAgg as FigureCanvas
import statsmodels.api as sm
import urllib
import StringIO
import cPickle
import pandas as pd
import patsy
import MySQLdb
import json

# Constants
server = 'localhost'
username = 'root'
password = ''
database = 'app'

# Connect mysql database
con = MySQLdb.connect(server, username, password, database)

# Cross Origin Request Service Handler
@hook('after_request')
def enable_cors():
    response.headers["Access-Control-Allow-Origin"] = "*"
    response.headers["Access-Control-Allow_Methods"] = "GET, POST, OPTIONS"
    response.headers["Access-Control-Allow-Headers"] = "Authorization, Origin, Content-Type, Accept, X-Requested-With"

@route('/', method='OPTIONS')
@route('/<path:path>', method='OPTIONS')
def options_handler(path=None):
    return

@post('/getPrediction')
def handlePrediction():
    # Getting the data to be used for prediction
    keys = ["total_unemployed", "long_interest_rate", "federal_funds_rate",
            "consumer_price_index",
            "gross_domestic_product"]
    var = []
    for key in keys:
        var.append(float(request.forms.get(key)))

    # Setting up cursor to allow Python to interact with the database
    cur = con.cursor()

    # Get the pickled coefficients
    cur.execute("SELECT data from coeff")
    data = cur.fetchone()
    # Load model
    model = cPickle.loads(data[0])

    _df = pd.DataFrame([var], columns=["total_unemployed",
                                            "long_interest_rate",
                                            "federal_funds_rate",
                                            "consumer_price_index",
                                            "gross_domestic_product"])
    pred = model.predict(sm.add_constant(_df[["total_unemployed",
                                            "long_interest_rate",
                                            "federal_funds_rate",
                                            "consumer_price_index",
                                            "gross_domestic_product"]][:1]), transform=False)

    cur.close()

    return json.dumps(round(pred.tolist()[0], 2))

@get('/getCorrelation')
def handleCorrelation():
    imtype = 0
    try:
            imtype = int(request.query.imtype)
    except:
            return "Unknown Image ID requested"

    print(imtype)

    df = pd.read_sql("SELECT * FROM boston_dataset", con=con)
    if imtype==1:
        kendall_corr = df.corr('kendall')['housing_price_index'].sort_values().plot.bar()
        canvas = FigureCanvas(kendall_corr.get_figure())
        png_output = StringIO.StringIO()
        canvas.print_png(png_output)
        data = png_output.getvalue().encode('base64')
        plt.clf()

        return '<img src="data:image/png;base64,{}">'.format(urllib.quote(data.rstrip('\n')))
    elif imtype==2:
        corr = df.corr()['housing_price_index'].sort_values().plot.bar()
        canvas = FigureCanvas(corr.get_figure())
        png_output = StringIO.StringIO()
        canvas.print_png(png_output)
        data = png_output.getvalue().encode('base64')
        plt.clf()

        return '<img src="data:image/png;base64,{}">'.format(urllib.quote(data.rstrip('\n')))

    elif imtype==3:
        corr = df[["housing_price_index", "total_unemployed", "long_interest_rate", "federal_funds_rate",
                "consumer_price_index"]].plot()
        canvas = FigureCanvas(corr.get_figure())
        png_output = StringIO.StringIO()
        canvas.print_png(png_output)
        data = png_output.getvalue().encode('base64')
        plt.clf()

        return '<img src="data:image/png;base64,{}">'.format(urllib.quote(data.rstrip('\n')))

    elif imtype==4:
        table = df.describe().to_html()
        plt.clf()

        return table.rstrip('\n').replace("dataframe","table is-striped")

    else:
        return "-1"


run(host='localhost', port=8080, debug=True)
