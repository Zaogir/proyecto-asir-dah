# Módulos del proyecto

Proyecto final en equipo, con más de 400 horas de trabajo. Cada módulo se puede leer de forma independiente.

| Módulo | Qué se hizo | En este repositorio |
|---|---|---|
| **Virtualización con Proxmox** | Entorno virtual propio: elección de plataforma, instalación, creación de máquinas virtuales y despliegue del proyecto web sobre él. | Solo documentado |
| **Formularios web (Webs1)** | 3 formularios en PHP/HTML/CSS con MariaDB: login (admin/conserge), alta de profesor con código aleatorio enviado por correo y registro completo con foto y titulaciones. | `webs1-formularios/` |
| **WordPress (Webs2.1)** | Tienda online con base de datos dedicada, páginas (inicio, tienda, cuenta, nosotros, carrito, foro) y plugins (limit login, WPvivid backup, foro). | Solo documentado |
| **Power Apps (Webs2.2)** | Aplicación enlazada a la base de datos de los formularios: alta, consulta, edición y borrado de profesores. | Solo documentado |
| **Docker y Kubernetes** | Entorno LAMP con Docker Compose, orquestación con Docker Swarm (con *secrets* para no guardar contraseñas en claro) y exportación a Kubernetes. | `docker/dha.yml` |
| **Monitorización con Zabbix** | Monitorización de los servidores Zabbix y Webs2: políticas, triggers, scripts propios (ping y comprobación de Apache), dashboards e informes, y personalización del tema (`brand.conf.php`). | Solo documentado |
| **Automatización con Ansible** | 3 playbooks: comprobar conexión, comprobar red y actualizar paquetes, con avisos por correo. | `ansible/` |
| **IoT** | ESP32 con sensores (movimiento, humo, temperatura/humedad), pantalla y zumbador, integrado en Home Assistant con base de datos externa y 2 páginas web. | `iot/` (parcial) |
| **Centro de datos (CPD)** | Diseño de un CPD para una empresa hotelera (seguridad física, control de acceso, climatización, segmentación con VLAN, diseño eléctrico) y montaje práctico de 2 racks TOR. | Solo documentado |
| **Cloud con AWS** | WordPress y los formularios desplegados en AWS, más los laboratorios de los cursos de la plataforma (EC2, CloudFront, EBS, IAM, CloudWatch, RDS, balanceadores, Elastic Beanstalk, Lambda, Auto Scaling, CloudFormation…). | Solo documentado |
