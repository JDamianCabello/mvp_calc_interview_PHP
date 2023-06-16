## Proceso para solucionar el problema:

1.  **Recibir y verificar los archivos:** Se recibirán múltiples archivos, uno por cada partido jugado. Cada archivo debe comenzar con una fila que indique el deporte al que se refiere. Antes de procesar los archivos, se debe verificar si el formato de los archivos es correcto. Si alguno de los archivos está mal formateado, se considera que todo el conjunto de archivos es incorrecto y no se calculará el MVP (lanzando una excepción).

2.  **Leer y analizar cada archivo:** Para cada archivo de partido, se debe leer línea por línea y extraer la información relevante. Cada línea representa las estadísticas de un jugador en el partido, y se debe procesar para obtener los puntos anotados, así como su posición en el equipo y el nombre del equipo.

3.  **Calcular los puntos de clasificación de cada jugador:** Utilizando las reglas de puntuación para cada posición en el deporte seleccionado, se deben calcular los puntos de clasificación para cada jugador en cada partido. Esto implica multiplicar los puntos anotados por el factor correspondiente a su posición, sumar/restar los puntos extra según toque.

4.  **Determinar el equipo ganador:** Al finalizar cada partido, se debe determinar el equipo ganador comparando los puntos anotados por cada equipo. El equipo con más puntos será considerado el ganador del partido (esta métrica difiere según el deporte).

5.  **Asignar puntos adicionales al equipo ganador:** Si un equipo ganó el partido, se debe otorgar a cada jugador de ese equipo 10 puntos adicionales en su puntuación de clasificación.

6.  **Mantener un seguimiento de los partidos de cada jugador:** A medida que se procesan los archivos de los partidos, se debe mantener un seguimiento de la clasificación en cada partido.

7.  **Identificar al MVP:** Una vez que se hayan procesado todos los partidos y se haya calculado la puntuación total de cada jugador, se debe identificar al jugador con la puntuación más alta como el Jugador Más Valioso (MVP) del torneo.

8.  **Mostrar el MVP:** Por último, se debe mostrar el nombre o apodo del MVP junto con su puntuación total.


## ¿Porqué en PHP nativo?
La verdad con tantos frameworks de php como existen usar php nativo no es tan interesante como antes. Esta misma prueba podría haberla hecho en JavaScript o C# (incluso java que no tengo tanta experiencia pero para  esta prueba llegaría).

La gracia de usar PHP era el "utilizar" POO nativo y refrescar el como modo de interactuar de clases, patrones, etc (tipo el `Autoload.php`, siempre esta en los frameworks aquí tuve que investigar un poco).

Se ha usado la directiva **strict types**  en nuestros ficheros PHP.

> El uso de `declare(strict_types=1);` en PHP, habilitando el modo estricto de tipos, es beneficioso porque proporciona mayor precisión y seguridad al evitar conversiones automáticas de tipos, mejora la mantenibilidad del código al especificar los tipos de datos de forma explícita, reduce los errores en tiempo de ejecución al detectarlos durante el desarrollo y puede contribuir a un mejor rendimiento al evitar operaciones innecesarias de conversión de tipos.

Se han usado distintos patrones y obviamente se podría haber mejorado la solución **la prueba era con tiempo 4 horas de tiempo máximo**. Llegue a tenerlo funcional en unas 2:20h u así y luego he estado casi hasta las 3h  (un poco menos) refactorizando un poco el código.

Debido a la simpleza de los datos solo se han utilizado Modelos y Helpers para leer - parsear el input (ficheros de deporte).

También se podrían haber incluido más variables en el fichero config.ini (como la puntuación de cada posición) o incluso incluirlo dentro de un contenedor de docker pero creo que eso se distanciaba mucho de lo que es la prueba en sí.

## Uso del software

1.  **Instalar PHP 8.1:**

    -   Descarga la versión de PHP 8.1 adecuada para tu sistema operativo desde el sitio web oficial de PHP.
    -   Sigue las instrucciones de instalación específicas para tu sistema operativo. Puedes consultar la documentación oficial de PHP para obtener más detalles.
    -   Verifica la instalación ejecutando el comando `php -v` en la línea de comandos. Debería mostrar la versión de PHP 8.1 instalada.
2.  **Ejecutar el script `initializeMVPScript.php`:**

    -   Abre una ventana de terminal o línea de comandos.
    -   Navega hasta el directorio donde se encuentra el archivo `initializeMVPScript.php` utilizando el comando `cd` (ejemplo: `cd /ruta/del/archivo`).
    -   Ejecuta el comando `php initializeMVPScript.php` para ejecutar el script PHP.
    -   Si el script tiene alguna salida o resultado, debería mostrarse en la terminal.

Recuerda que estos pasos son una guía general y pueden variar dependiendo del sistema operativo y las configuraciones específicas. Asegúrate de seguir las instrucciones de instalación adecuadas para tu plataforma y ajusta los comandos y rutas según sea necesario.

## Output

    PLAYERS RESUME POINTS:
    
    [Basketball]
    ------------------------
    [player 1] -> 33 
    [player 2] -> 20 
    [player 3] -> 52 
    [player 4] -> 50 
    [player 5] -> 46 
    [player 6] -> 36 
    
    
    [Handball]
    ------------------------
    [player 1] -> 20 
    [player 2] -> 25 
    [player 3] -> 20 
    [player 4] -> 5 
    [player 5] -> 7 
    [player 6] -> 3 
    
    
    =========================
            RESULT:
    =========================
    The MVP is player 3 with 72 points, theres a resume of games.
    [Basketball]: Positiom {C} in team {Team A} with {52} points | winner team: Team B
    [Handball]: Positiom {F} in team {Team A} with {20} points | winner team: Team A
