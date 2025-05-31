# EduCraft API

desarrollada en Laravel que permite gestionar cursos, lecciones, instructores, comentarios y favoritos. 
Este proyecto proporciona una API REST para interactuar con los datos de la plataforma.

---

## **Funcionalidades**
- **Instructores**: Un instructor puede tener varios cursos.
- **Cursos**: Un curso pertenece a un instructor y puede tener varias lecciones.
- **Lecciones**: Cada lección contiene un video.
- **Comentarios y Calificaciones**: Los usuarios pueden dejar comentarios y evaluaciones en los cursos.
- **Favoritos**: Los usuarios pueden marcar cursos como favoritos.

---

## **Tecnologías Utilizadas**
- **Framework**: Laravel 12
- **Base de Datos**: MySQL
- **Autenticación**: Laravel Sanctum
- **API REST**: Endpoints para CRUD e interacciones con la plataforma.

---

## **Instalación**

### **Requisitos Previos**
- PHP 8.1 o superior
- Composer
- MySQL
- Docker

### **Pasos**
1. Clona el repositorio:
     ```bash
     git clone https://github.com/kaioken200x/EduCraft.git
     cd EduCraft
     ```

2. Configura el archivo `.env`:
      - Edita el archivo `.env` en la raíz del proyecto para configurar las credenciales de la base de datos. Ejemplo:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=educraft
        DB_USERNAME=root
        DB_PASSWORD=tu_contraseña
        ```

3. Ejecuta las migraciones para crear las tablas en la base de datos:
      ```bash
      php artisan migrate
      ```

---

### **RUTAS**
#### **Autenticación**

##### **Registrar Usuario**
- **POST** `/api/register`  
      Registra un nuevo usuario.  
      Ejemplo:  
      ```bash
      curl -X POST http://localhost:8000/api/register \
      -H "Content-Type: application/json" \
      -d '{"nombre": "Maria Silva", "email": "maria@email.com", "password": "contraseña123"}'
      ```

##### **Iniciar Sesión**
- **POST** `/api/login`  
      Inicia sesión y devuelve un token de autenticación.  
      Ejemplo:  
      ```bash
      curl -X POST http://localhost:8000/api/login \
      -H "Content-Type: application/json" \
      -d '{"email": "maria@email.com", "password": "contraseña123"}'
      ```

      Respuesta esperada:  
      ```json
      {
            "token": "tu-token-aqui"
      }
      ```

---

### **Ejemplos de Llamadas a Rutas**

Todas las llamadas a la API requieren el encabezado `Authorization` con el token Bearer para autenticación. Ejemplo:  

```bash
-H "Authorization: Bearer tu-token-aqui"
```

#### **Instructores**
- **GET** `/api/instructores`  
      Devuelve la lista de instructores.  
      Ejemplo:  
      ```bash
      curl -X GET http://localhost:8000/api/instructores
      ```

- **POST** `/api/instructores`  
      Crea un nuevo instructor.  
      Ejemplo:  
      ```bash
      curl -X POST http://localhost:8000/api/instructores \
      -H "Content-Type: application/json" \
      -d '{"nombre": "Juan Silva", "email": "juan@email.com"}'
      ```

- **PUT** `/api/instructores/{id}`  
      Actualiza un instructor existente.  
      Ejemplo:  
      ```bash
      curl -X PUT http://localhost:8000/api/instructores/1 \
      -H "Content-Type: application/json" \
      -d '{"nombre": "Juan Silva Actualizado", "email": "juan_actualizado@email.com"}'
      ```

- **DELETE** `/api/instructores/{id}`  
      Elimina un instructor.  
      Ejemplo:  
      ```bash
      curl -X DELETE http://localhost:8000/api/instructores/1
      ```

#### **Cursos**
- **GET** `/api/cursos`  
      Devuelve la lista de cursos.  
      Ejemplo:  
      ```bash
      curl -X GET http://localhost:8000/api/cursos
      ```

- **POST** `/api/cursos`  
      Crea un nuevo curso.  
      Ejemplo:  
      ```bash
      curl -X POST http://localhost:8000/api/cursos \
      -H "Content-Type: application/json" \
      -d '{"titulo": "Curso de Laravel", "instructor_id": 1}'
      ```

- **PUT** `/api/cursos/{id}`  
      Actualiza un curso existente.  
      Ejemplo:  
      ```bash
      curl -X PUT http://localhost:8000/api/cursos/1 \
      -H "Content-Type: application/json" \
      -d '{"titulo": "Curso de Laravel Actualizado", "instructor_id": 1}'
      ```

- **DELETE** `/api/cursos/{id}`  
      Elimina un curso.  
      Ejemplo:  
      ```bash
      curl -X DELETE http://localhost:8000/api/cursos/1
      ```

#### **Lecciones**
- **GET** `/api/lecciones`  
      Devuelve la lista de lecciones.  
      Ejemplo:  
      ```bash
      curl -X GET http://localhost:8000/api/lecciones
      ```

- **POST** `/api/lecciones`  
      Crea una nueva lección.  
      Ejemplo:  
      ```bash
      curl -X POST http://localhost:8000/api/lecciones \
      -H "Content-Type: application/json" \
      -d '{"titulo": "Introducción a Laravel", "curso_id": 1, "video_url": "http://video.com/intro.mp4"}'
      ```

- **PUT** `/api/lecciones/{id}`  
      Actualiza una lección existente.  
      Ejemplo:  
      ```bash
      curl -X PUT http://localhost:8000/api/lecciones/1 \
      -H "Content-Type: application/json" \
      -d '{"titulo": "Introducción a Laravel Actualizada", "curso_id": 1, "video_url": "http://video.com/intro_actualizado.mp4"}'
      ```

- **DELETE** `/api/lecciones/{id}`  
      Elimina una lección.  
      Ejemplo:  
      ```bash
      curl -X DELETE http://localhost:8000/api/lecciones/1
      ```

#### **Comentarios**
#### **Comentarios y Calificaciones**

- **POST** `/api/comentarios`  
     Añade un comentario y calificación a un curso.  
     Ejemplo:  
     ```bash
     curl -X POST http://localhost:8000/api/comentarios \
     -H "Content-Type: application/json" \
     -d '{"curso_id": 1, "usuario_id": 2, "comentario": "¡Excelente curso!", "calificacion": 5}'
     ```

- **PUT** `/api/comentarios/{id}`  
     Actualiza un comentario y/o calificación existente.  
     Ejemplo:  
     ```bash
     curl -X PUT http://localhost:8000/api/comentarios/1 \
     -H "Content-Type: application/json" \
     -d '{"comentario": "¡Curso actualizado!", "calificacion": 4}'
     ```

- **DELETE** `/api/comentarios/{id}`  
     Elimina un comentario y su calificación.  
     Ejemplo:  
     ```bash
     curl -X DELETE http://localhost:8000/api/comentarios/1
     ```

#### **Favoritos**
- **POST** `/api/favoritos`  
      Marca un curso como favorito.  
      Ejemplo:  
      ```bash
      curl -X POST http://localhost:8000/api/favoritos \
      -H "Content-Type: application/json" \
      -d '{"curso_id": 1, "usuario_id": 2}'
      ```

- **GET** `/api/favoritos`  
      Devuelve los cursos favoritos de un usuario.  
      Ejemplo:  
      ```bash
      curl -X GET http://localhost:8000/api/favoritos?usuario_id=2
      ```

- **DELETE** `/api/favoritos/{id}`  
      Elimina un curso de los favoritos.  
      Ejemplo:  
      ```bash
      curl -X DELETE http://localhost:8000/api/favoritos/1
      ```
