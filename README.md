# DAH · Creación y monitorización de un entorno web

Proyecto final del ciclo **ASIR** (Administración de Sistemas Informáticos en Red) en el IES Sa Palomera.
Es un conjunto de miniproyectos conectados entre sí que cubren un entorno web completo: desde la
virtualización y el desarrollo de formularios hasta contenedores, monitorización, automatización, IoT,
un centro de datos y servicios cloud. Más de 400 horas de trabajo en equipo.

> Memoria original en catalán. Este repositorio recoge el código y las configuraciones reconstruidos a partir de ella.

## Equipo
- Alex Carles Fuertes Hasenbalg
- Dennis Sorin Bancila Ionescu
- Hemant Mansukhani Udhwani

## Tecnologías
`Proxmox VE` · `Ubuntu Server` · `PHP` · `MariaDB/MySQL` · `HTML/CSS/JS` · `WordPress` · `Power Apps` ·
`Docker Compose / Swarm` · `Kubernetes` · `Zabbix` · `Ansible` · `ESP32 / ESPHome / Home Assistant` · `AWS`

## Estructura
```
webs1-formularios/   Formularios PHP + MariaDB (login, alta de profesor con código por correo, registro)
docker/              Entorno LAMP con Docker Compose (dha.yml)
ansible/             Playbooks de conexión, red y actualización con avisos por correo
iot/                 ESP32 + sensores + Home Assistant (conexiones; YAML pendiente)
docs/                Resumen de cada módulo
```
Detalle de todos los módulos (incluidos los que solo están documentados) en [`docs/modulos.md`](docs/modulos.md).

## Puesta en marcha

### Formularios (webs1-formularios)
```bash
# Requisitos: PHP 8 + Apache, MariaDB/MySQL, Composer
cd webs1-formularios
composer install                       # instala PHPMailer
mysql -u root -p < schema.sql          # crea la base de datos "formulari"
cp .env.example .env                   # y exporta las variables al servidor web
mkdir fotos                            # carpeta donde se guardan las fotos subidas
```
Entrada: `Formulari1.php` (inicio de sesión). `admin` ve los datos; `conserge` accede al Formulario 2.

### Entorno LAMP con Docker
```bash
cd docker
cp .env.example .env
docker compose -f dha.yml up -d        # web en :80, phpMyAdmin en :8080
```

### Ansible
Ver [`ansible/README.md`](ansible/README.md).

## Sobre la reconstrucción del código
Se ha reconstruido a partir del texto y las capturas de la memoria, con estos cambios:
- **Credenciales eliminadas**: contraseñas de base de datos y de correo sustituidas por variables de entorno / Ansible Vault.
- Correcciones menores de transcripción (etiquetas HTML y una sentencia SQL mal copiadas en la memoria).
- `schema.sql` se ha **inferido** de las consultas del código; revisa tipos y longitudes si necesitas el esquema exacto.

## Limitaciones conocidas (proyecto académico)
Como mejoras pendientes: usar *prepared statements* (hay consultas construidas por concatenación, vulnerables a inyección SQL),
guardar contraseñas con `password_hash` en lugar de SHA-256 sin sal, validar el tipo y tamaño de las imágenes subidas,
escapar la salida HTML y proteger las páginas de administración con sesiones.
