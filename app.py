from flask import Flask, render_template, request
import pickle
import numpy as np

app = Flask(__name__)

# Prediction


def prediction(lst):
    filename = 'model/predictor.pickle'
    with open(filename, 'rb') as file:
        model = pickle.load(file)
    pred_value = model.predict([lst])
    return pred_value


@app.route('/', methods=['POST', 'GET'])
def index():
    pred = 0
    if request.method == 'POST':
        size = request.form['size']
        fabric = request.form['fabric']
        color1 = request.form['color1']
        color2 = request.form['color2']
        color3 = request.form['color3']
        color4 = request.form['color4']
        # print(color1, color2, color3, color4)

        # List making to get features
        feature_list = [0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0]

        # For size
        if size == 's':
            feature_list[17] = 1
        if size == 'm':
            feature_list[16] = 1
        if size == 'l':
            feature_list[15] = 1
        if size == 'xl':
            feature_list[18] = 1

        # For fabric
        if fabric == 'linen':
            feature_list[8] = 1
        if fabric == 'rayon':
            feature_list[9] = 1
        if fabric == 'cotton':
            feature_list[7] = 1
        if fabric == 'silk':
            feature_list[10] = 1

        # For color
        if color1 == '1':
            feature_list[0] = 1
        if color2 == '1':
            feature_list[1] = 1
        if color3 == '1':
            feature_list[2] = 1
        if color4 == '1':
            feature_list[3] = 1

        print(feature_list)

        pred = prediction(feature_list)
        pred = np.round(pred[0])
        print(pred)

    return render_template("index.html", pred=pred)


if __name__ == '__main__':
    app.run(debug=True, port=8000)