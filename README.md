# 📋 Sistema de Login y CRUD en PHP

## 🚀 Descripción del Proyecto
Este proyecto es un sistema de gestión de usuarios con funcionalidades de login, registro, y operaciones CRUD (Crear, Leer, Actualizar, Eliminar) desarrollado completamente en PHP.

## ✨ Características
- 🔐 Autenticación de usuarios
- 📝 Registro de nuevos usuarios
- 👤 Gestión de perfiles de usuario
- 🛠️ Operaciones CRUD completas


## 🛠️ Requisitos del Sistema
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Navegador web moderno

## 📦 Instalación

### Pasos para Configurar

1. Clonar el repositorio
```bash
git clone https://github.com/CarlosReyes99/loginSecurePHP.git
cd loginSecurePHP
```

2. Configurar base de datos
- Crear una base de datos MySQL
- Importar y ejecutar el archivo `backup.sql` incluido en el proyecto


3. Configurar conexión
```php
<?php
$host = 'localhost';
$db   = 'tech';
$user = 'tu_usuario';
$pass = 'tu_contraseña';
$charset = 'utf8mb4';
```

## 🔑 Funcionalidades Principales

### Autenticación
- Registro de usuarios
- Inicio de sesión
- Recuperación de contraseña
- Cierre de sesión

### Gestión de Usuarios (CRUD)
- Crear nuevos usuarios
- Visualizar lista de usuarios
- Editar información de usuario
- Eliminar usuarios
- Subir y actualizar imágenes de perfil


## 🔒 Seguridad
- Encriptación de contraseñas con password_hash()
- Protección contra inyección SQL
- Validación de entrada de usuario
- Uso de prepared statements
- Implementación de CSRF tokens


## 🤝 Contribuciones
¡Las contribuciones son bienvenidas! Por favor lee las guías de contribución antes de enviar un pull request.

## 📄 Licencia
Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para detalles

## 🙏 Agradecimientos
- PHP
- MySQL
- Bootstrap (si se usa)
- Otras librerías/frameworks utilizados

📸 Capturas de Pantalla
<div align="center">
  <img src="https://i.imgur.com/ceYwtvD.jpeg" width="400" alt="Pantalla de Login">
  <img src="https://i.imgur.com/nk4qIuV.jpeg" width="400" alt="Panel de Control">
  <img src="https://i.imgur.com/zO2Glh3.jpeg" width="400" alt="Agregar producto">
  <img src="https://i.imgur.com/AKIJLtX.jpeg" width="400" alt="Editar producto">
  <img src="https://i.imgur.com/asNOGDC.jpeg" width="400" alt="Eliminar producto">
  
</div>
