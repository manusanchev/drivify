# drivify

## Idea general
El proyecto consistirá en la creación de una lista de reproducción de Spotify con canciones elegidas de forma proporcional por los ocupantes del vehículo de tal forma que la suma de la duración de todas las canciones de esa lista de reproducción sea similar a la duración del trayecto.

Como todo en esta vida, se comprenderá mejor con un ejemplo:
Imaginemos que José María quiere ir desde Sanlúcar hasta Sevilla con su flamante Porsche, pero para ahorrar, decide publicitarse en “bla bla car”. Esto hace que Manuel, Miguel y Sergio se unan a su viaje. 
Antes de comenzar el viaje, José maría pone la canción “huevos con aceite”, pero resulta que a Miguel no le gusta demasiado y desea poner otra canción.

José maría hará uso de mi aplicación para solventar este problema.

Para ello entra en la web, inicia sesión en su cuenta e introduce la salida y el destino del viaje, luego se generará un código, este código lo usarán las otras personas desde sus respectivas cuentas en la web para meterse en la sala de reproducción donde encontrarán un campo de búsqueda para elegir las canciones que quieran, pero no podrán poner el número de canciones que les dé la gana, el sistema elegido para el reparto de canciones se basa en el tiempo que tardará en llegar a su destino entre el número de personas en el coche
Una vez las personas elijan sus canciones, la web creará una lista de reproducción en la cuenta de Spotify, de la persona que haya creado la sala, con las canciones ordenadas de manera que se garantice el reparto proporcional.
## Tecnologias utilizadas
Vue y Laravel
