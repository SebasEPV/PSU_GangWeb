from flask import Flask, request, jsonify

#Metodo magico para ejecutar la aplicacion por si sola

app = Flask(__name__)

automatic_response={
    'hola': '¡Hola! ¿Cómo puedo ayudarte hoy?',
    'adios': '¡Adiós! Que tengas un buen día.',
    'gracias': '¡De nada! Estoy aquí para ayudar.',
    'ayuda': '¿En qué necesitas ayuda?',
    'tiempo': 'El clima hoy está soleado con una temperatura de 25°C.',
    'nombre': 'Soy tu asistente virtual, creado para ayudarte.'
}

def process_messages(message):
    message=message.lower()
    for key in automatic_response:
        if key in message:
            return automatic_response[key]
    return "No estoy seguro de cómo responder a eso. ¿Puedes reformular tu pregunta?"


#Decorador @, invocar una funcion antes de ejecutar la funcion siguiente
@app.route('/chatbot', methods=['POST'])
def chatbot():
    data=request.json
    if 'message' in data:
        message=data['message']
        response=process_messages(message)
        return jsonify({'response':response})
    else:
        return jsonify({'Error no se proporcionó un mensaje'}),400
    
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
    

    
    