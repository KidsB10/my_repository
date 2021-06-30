import requests, uuid, json
from flask import Flask, render_template, request
from azure.cognitiveservices.speech import AudioDataStream, SpeechConfig, SpeechSynthesizer
from azure.cognitiveservices.speech.audio import AudioOutputConfig

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/', methods=['POST'])
def result():
    message=request.form['message']
    number=request.form['number']

    speech_config = SpeechConfig(subscription="0a6a0817af9f46aea9054beaa3d30290", region="westeurope")
    audio_config = AudioOutputConfig(filename="message_fr.wav")
    speech_config.speech_synthesis_voice_name = "fr-FR-DeniseNeural"
    synthesizer = SpeechSynthesizer(speech_config=speech_config, audio_config=audio_config)
    synthesizer.speak_text_async(message)

    # Add your subscription key and endpoint
    subscription_key = "e134037165514c648a57bf6ccc95e541"
    endpoint = "https://api.cognitive.microsofttranslator.com"

    # Add your location, also known as region. The default is global.
    # This is required if using a Cognitive Services resource.
    location = "francecentral"

    path = '/translate'
    constructed_url = endpoint + path

    params = {
        'api-version': '3.0',
        'from': 'fr',
        'to': ['en']
    }
    constructed_url = endpoint + path

    headers = {
        'Ocp-Apim-Subscription-Key': subscription_key,
        'Ocp-Apim-Subscription-Region': location,
        'Content-type': 'application/json',
        'X-ClientTraceId': str(uuid.uuid4())
    }

    # You can pass more than one object in body.
    body = [{
        'text': message
    }]

    quest = requests.post(constructed_url, params=params, headers=headers, json=body)
    response = quest.json()

    translator = response[0]["translations"][0]["text"]

    audio_config = AudioOutputConfig(filename="message_en.wav")
    speech_config.speech_synthesis_voice_name = "en-US-AriaNeural"
    synthesizer = SpeechSynthesizer(speech_config=speech_config, audio_config=audio_config)
    synthesizer.speak_text_async(translator)

    data = {"number": number}
    with open("limit.json", "w") as file:
        json.dump(data, file)

    return (message)


