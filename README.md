# Toc

- [Toc](#toc)
- [LFG Discord](#lfg-discord)
- [How to use it](#how-to-use-it)
- [Endpoints](#endpoints)
    - [Auth](#auth)
    - [Channel](#channel)
    - [Message](#message)
    - [SuperAdmin](#superadmin)
- [EER Diagram](#eer-diagram)
  - [Author](#author)
      - [Luciano Germani :it:](#luciano-germani-it)


# LFG Discord

*If you prefer you can read this in* [Spanish](README-ESP.md)

This project, it's a replication of Discord server where you can register a new user, Create a new channel and write messages inside the channel.
All this project has been made whit Laravel.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# How to use it

To be able to use it you will need to install Postman ((https://www.postman.com/) and aim to this heroku server: https://lfd-discord.herokuapp.com/api




# Endpoints

Here you can find all the methods you can use on Postman to be able to do your research

### Auth

POST / register --> You can register a new user

POST / login --> You can login 

GET / me  --> To see your profile

PUT / editProfile/id  --> You can edit your profile 

GET / logout --> You can log out from the App


### Channel

POST / addChannel/id --> You can add a new channel 

POST / addUserToChannel/id --> You can add user to channel

GET / channel --> You can get all channel

GET / channel/id  --> You can get the channel by is own id

PUT / channel/id  --> You can edit the channel

DELETE / deleteUserFromChannel/id --> You can remove user from channel

DELETE / deleteChannel/id --> You can delete the channel



### Message

POST / addMessage/id--> You can add a new message to the channel 

GET / message/id --> You can get all the messages by the channel id

PUT / message/id --> You can edit the message

DELETE / deleteMessage/id --> You can delete the message


### SuperAdmin

POST / addRoleSuperAdmin/id --> Can add new role to user

DELETE / deleteRoleSuperAdmin/id --> Can remove role from user


# EER Diagram

![Diagram](imgReadme/EER%20Diagram.png)

## Author 	

#### [Luciano Germani](https://github.com/Germanilu) :it:

---------------------

[:top:](#toc)

