from flask import Flask, request, jsonify

#Metodo magico para ejecutar la aplicacion por si sola

app = Flask(__name__)

automatic_response={
    'hola': '¡Hola! ¿Cómo puedo ayudarte hoy?',
    'adios': '¡Adiós! Que tengas un buen día.',
    'gracias': '¡De nada! Estoy aquí para ayudar.',
    'ayuda': '¿En qué necesitas ayuda?',
    'tiempo': 'El clima hoy está soleado con una temperatura de 25°C.',
    'nombre': 'Soy tu asistente virtual, creado para ayudarte.',
    'como instalar windows': 'Para instalar Windows, necesitarás un disco de instalación o una unidad USB con el instalador de Windows. Arranca desde este dispositivo y sigue las instrucciones en pantalla.',
    'mejor antivirus para pc': 'Algunos de los mejores antivirus para PC incluyen Bitdefender, Norton y Kaspersky.',
    'como limpiar mi pc': 'Para limpiar tu PC, apágala y desconéctala. Usa aire comprimido para limpiar el polvo del interior y un paño suave para limpiar la pantalla y el teclado.',
    'mi pc no enciende': 'Si tu PC no enciende, verifica que esté conectada a la corriente, intenta con otro cable de alimentación y asegúrate de que el interruptor de encendido esté en la posición correcta.',
    'mejor procesador para juegos': 'Actualmente, algunos de los mejores procesadores para juegos son el Intel Core i9-12900K y el AMD Ryzen 9 5900X.',
    'como formatear una pc': 'Para formatear una PC, ve a la configuración de Windows, selecciona "Actualización y seguridad", luego "Recuperación" y finalmente "Restablecer esta PC".',
    'mi pc está lenta': 'Si tu PC está lenta, intenta desinstalar programas no utilizados, limpiar el disco duro y aumentar la memoria RAM.',
    'que es una placa base': 'La placa base es el componente principal de una PC que conecta todos los demás componentes, como el procesador, la memoria RAM y los dispositivos de almacenamiento.',
    'cuanta ram necesito': 'Para tareas básicas, 8GB de RAM son suficientes. Para juegos y edición de video, se recomienda al menos 16GB.',
    'mejor tarjeta gráfica': 'Algunas de las mejores tarjetas gráficas actualmente son la NVIDIA GeForce RTX 3080 y la AMD Radeon RX 6800 XT.',
    'como actualizar drivers': 'Para actualizar drivers, ve al Administrador de dispositivos, selecciona el dispositivo que deseas actualizar, haz clic derecho y selecciona "Actualizar controlador".',
    'que es un ssd': 'Un SSD (Solid State Drive) es un dispositivo de almacenamiento que utiliza memoria flash para guardar datos, ofreciendo velocidades mucho más rápidas que un disco duro tradicional.',
    'diferencia entre ssd y hdd': 'La principal diferencia entre SSD y HDD es que los SSD son mucho más rápidos y duraderos, mientras que los HDD son más económicos y ofrecen mayor capacidad de almacenamiento.',
    'como hacer overclocking': 'Para hacer overclocking, ingresa al BIOS de tu PC, busca las opciones de overclocking y ajusta las configuraciones del procesador y la memoria RAM.',
    'mi pc se reinicia sola': 'Si tu PC se reinicia sola, podría ser un problema de sobrecalentamiento, fallo de hardware o software malicioso. Revisa las temperaturas y realiza un análisis de virus.',
    'como desfragmentar un disco': 'Para desfragmentar un disco en Windows, abre el Desfragmentador de disco, selecciona la unidad que deseas desfragmentar y haz clic en "Optimizar".',
    'que es una tarjeta gráfica': 'Una tarjeta gráfica es un componente de hardware que se encarga de renderizar imágenes y videos en la pantalla del ordenador.',
    'mi pc no reconoce el disco duro': 'Si tu PC no reconoce el disco duro, verifica las conexiones físicas y asegúrate de que el disco duro esté correctamente configurado en el BIOS.',
    'como montar una pc': 'Para montar una PC, necesitas una placa base, procesador, memoria RAM, almacenamiento, tarjeta gráfica, fuente de alimentación y una carcasa. Ensambla todos los componentes siguiendo las instrucciones del fabricante.',
    'mejor monitor para juegos': 'Algunos de los mejores monitores para juegos incluyen el ASUS ROG Swift PG279Q y el Acer Predator X27.',
    'mi pc no tiene sonido': 'Si tu PC no tiene sonido, verifica las conexiones de los altavoces o auriculares, asegúrate de que el volumen no esté silenciado y actualiza los controladores de audio.',
    'como instalar linux': 'Para instalar Linux, descarga una distribución de Linux (como Ubuntu), crea una unidad USB de arranque, arranca desde esta unidad y sigue las instrucciones en pantalla.',
    'diferencia entre hdmi y displayport': 'HDMI y DisplayPort son interfaces de video. HDMI es más común en televisores y monitores, mientras que DisplayPort ofrece mayores resoluciones y frecuencias de actualización, ideal para juegos.',
    'mi pc se calienta mucho': 'Si tu PC se calienta mucho, asegúrate de que los ventiladores y disipadores de calor estén limpios, mejora la ventilación de tu carcasa y considera usar una base refrigerante.',
    'que es la bios': 'La BIOS (Basic Input/Output System) es el firmware que se ejecuta al encender la PC, inicializa el hardware y arranca el sistema operativo.',
    'como entrar en la bios': 'Para entrar en la BIOS, reinicia tu PC y presiona la tecla indicada (generalmente F2, Del, o Esc) durante el arranque.',
    'mi pc no se conecta a internet': 'Si tu PC no se conecta a internet, verifica las conexiones de red, reinicia el router y asegúrate de que los controladores de red estén actualizados.',
    'como hacer copia de seguridad': 'Para hacer una copia de seguridad en Windows, utiliza la herramienta de Historial de archivos o una solución de terceros como Acronis True Image.',
    'mejor teclado mecánico': 'Algunos de los mejores teclados mecánicos incluyen el Corsair K95 RGB Platinum y el Razer BlackWidow Elite.',
    'como actualizar bios': 'Para actualizar la BIOS, descarga la actualización desde el sitio web del fabricante de tu placa base y sigue las instrucciones específicas proporcionadas.',
    'que es un procesador': 'El procesador (CPU) es el componente central de una PC que realiza cálculos y ejecuta instrucciones de programas.',
    'mi pc no detecta la ram': 'Si tu PC no detecta la RAM, asegúrate de que los módulos estén correctamente insertados y verifica que sean compatibles con tu placa base.',
    'como instalar drivers': 'Para instalar drivers, descarga los controladores adecuados desde el sitio web del fabricante y sigue las instrucciones de instalación.',
    'mejor software de edición de video': 'Algunos de los mejores softwares de edición de video incluyen Adobe Premiere Pro, Final Cut Pro y DaVinci Resolve.',
    'que es la gpu': 'La GPU (Unidad de Procesamiento Gráfico) es un componente especializado en renderizar gráficos y realizar cálculos en paralelo, utilizada en tarjetas gráficas.',
    'mi pc no arranca': 'Si tu PC no arranca, verifica las conexiones de alimentación, asegúrate de que todos los componentes estén correctamente instalados y prueba con otra fuente de alimentación.',
    'como limpiar ventiladores de pc': 'Para limpiar los ventiladores de la PC, usa aire comprimido para eliminar el polvo y un paño suave para limpiar las aspas.',
    'que es un sistema operativo': 'Un sistema operativo (SO) es el software que gestiona los recursos del hardware y proporciona servicios a los programas de aplicación.',
    'mi pc no reconoce el usb': 'Si tu PC no reconoce el USB, prueba con otro puerto, verifica si el dispositivo funciona en otra PC y actualiza los controladores USB.',
    'como hacer dual boot': 'Para hacer dual boot, instala un segundo sistema operativo en una partición separada de tu disco duro y configura el gestor de arranque para seleccionar entre los sistemas operativos al iniciar.',
    'que es la ram': 'La RAM (Memoria de Acceso Aleatorio) es la memoria volátil que la PC utiliza para almacenar datos temporales mientras está en funcionamiento.',
    'mi pc se congela': 'Si tu PC se congela, puede ser debido a sobrecalentamiento, problemas de hardware o software malicioso. Verifica las temperaturas y realiza un análisis de virus.',
    'como instalar una tarjeta gráfica': 'Para instalar una tarjeta gráfica, apaga tu PC, inserta la tarjeta en una ranura PCIe disponible y conecta los cables de alimentación necesarios.',
    'mejor software de diseño gráfico': 'Algunos de los mejores softwares de diseño gráfico incluyen Adobe Photoshop, CorelDRAW y Affinity Designer.',
    'que es un disco duro': 'Un disco duro (HDD) es un dispositivo de almacenamiento que utiliza platos magnéticos para guardar datos de forma permanente.',
    'mi pc no detecta la tarjeta gráfica': 'Si tu PC no detecta la tarjeta gráfica, asegúrate de que esté correctamente insertada, verifica las conexiones de alimentación y actualiza los controladores.',
    'como optimizar mi pc para juegos': 'Para optimizar tu PC para juegos, actualiza los controladores, ajusta la configuración gráfica, cierra programas en segundo plano y desfragmenta tu disco duro.',
    'que es la memoria virtual': 'La memoria virtual es un área del disco duro que el sistema operativo utiliza como si fuera RAM adicional.',
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
    

    
    