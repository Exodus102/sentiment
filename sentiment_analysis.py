from flask import Flask, request, jsonify
from flask_cors import CORS
import tweetnlp

# Load the model
model = tweetnlp.load_model('sentiment', multilingual=True)

# Initialize Flask app
app = Flask(__name__)
CORS(app)  # Enable CORS

@app.route('/analyze-sentiment', methods=['POST'])
def analyze_sentiment():
    # Get the JSON data from the request
    data = request.get_json()
    if not data or 'text' not in data:
        return jsonify({'error': 'Text is required'}), 400

    user_input = data['text'].strip()
    if not user_input:
        return jsonify({'error': 'Text cannot be empty'}), 400

    try:
        # Perform sentiment analysis
        result = model.sentiment(user_input, return_probability=True)
        return jsonify({'text': user_input, 'sentiment': result}), 200
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
