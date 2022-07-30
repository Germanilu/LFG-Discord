# Toc

- [Toc](#toc)
- [LFG Discord](#lfg-discord)
- [Instrucciones](#instrucciones)
- [Endpoints](#endpoints)
    - [Auth](#auth)
    - [Channel](#channel)
    - [Message](#message)
    - [SuperAdmin](#superadmin)
- [EER Diagrama](#eer-diagrama)
  - [Autor](#autor)
      - [Luciano Germani :it:](#luciano-germani-it)



# LFG Discord

*Si lo prefieres puedes leer esto en [Ingles](README.md)*

Este proyecto es una replica de un servidor de Discord, donde puedes registrar un nuevo usuario, crear un canal y enviar mensajes en el canal.
El proyecto esta echo con Laravel.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Instrucciones

Para poder lanzar peticiones necesitamos utilizar Postman (https://www.postman.com) y apuntar a este servidor de heroku: https://lfd-discord.herokuapp.com/api


# Endpoints

A continuación se especifican el método a introducir en Postman, y lo que debemos introducir a continuación de la raiz para acceder a cada uno de los endpoints.

### Auth

POST / register --> Puedes registrar un usuario

POST / login --> Puedes loguear el usuario

GET / me  --> Puedes ver el perfil del usuario

PUT / editProfile/id  --> Puedes modificar el perfil 

GET / logout --> Puedes hacer el logout del usuario


### Channel

POST / addChannel/id --> Puedes añadir un nuevo canal

POST / addUserToChannel/id --> Puedes añadir un usuario al canal

GET / channel --> Puedes obtener todos los canales

GET / channel/id  --> Puedes ver un canal por su id

PUT / channel/id  --> Puedes modificar el canal

DELETE / deleteUserFromChannel/id --> Puedes remover el usuario del canal

DELETE / deleteChannel/id --> Puedes borrar el canal



### Message

POST / addMessage/id--> Puedes añadir un nuevo mensaje al canal

GET / message/id --> Puedes revisar todos los mensajes de un canal

PUT / message/id --> Puedes modificar el mensaje

DELETE / deleteMessage/id --> Puedes modificar el mensaje


### SuperAdmin

POST / addRoleSuperAdmin/id --> Puedes añadir un rol de superadmin a un usuario

DELETE / deleteRoleSuperAdmin/id --> Puedes remover el rol superadmin de un usuario


# EER Diagrama

![Diagram](imgReadme/EER%20Diagram.png)

## Autor

#### [Luciano Germani](https://github.com/Germanilu) :it:

---------------------

[:top:](#toc)

