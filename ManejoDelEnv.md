# [¡NOTA IMPORTANTE!] CUIDADO CON TENER EL .ENV EN LOCAL O PRODUCTION

# Configuración general de la aplicación
APP_NAME=Laravel
APP_ENV=local            # Establecer como 'local' en desarrollo
APP_KEY=base64:G0HCe+N1/0JR3rl92sgrzSwXOIJLRtKrgS1yPEriFwE=   # Clave de encriptación (cambia cuando generes una nueva)
APP_DEBUG=true           # Activar debug en local, en producción debería ser false
APP_TIMEZONE=UTC         # Configurar zona horaria
APP_URL=http://localhost # URL de la aplicación en local

# Configuración de base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1        # Dirección del servidor MySQL en local
DB_PORT=3306             # Puerto de MySQL
DB_DATABASE=projecte     # Nombre de la base de datos
DB_USERNAME=root         # Usuario para conectar a la base de datos
DB_PASSWORD=             # Dejar vacío si no hay contraseña para root en local

