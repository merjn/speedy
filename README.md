```
   ___     _ __                      _     _  _  
  / __|   | '_ \   ___     ___    __| |   | || | 
  \__ \   | .__/  / -_)   / -_)  / _` |    \_, | 
  |___/   |_|__   \___|   \___|  \__,_|   _|__/  
_|"""""|_|"""""|_|"""""|_|"""""|_|"""""|_| """"| 
"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-' 
```
Speedy is a Habbo emulator in PHP. It is currently in development and is not ready for production use. 
It targets the Habbo V1 client.

### Index
- [Architecture](#architecture)
- [Installation](#installation)
- [A note about the database](#a-note-about-the-database)

## Architecture[¶](#architecture "Permalink to this headline")
Speedy uses a modular monolith. This means that the application is split into modules, but the modules are not
separated into separate applications. 

Necessary communication between modules is done through events or through interfaces. This allows for a more
flexible architecture, where modules can be easily replaced or removed. Events represent an asynchronous way of
communicating between modules, while interfaces represent a synchronous way of communicating between modules.

#### Modules
The following modules are currently available:
- `Routing` - Handles routing of requests to the correct controller. It also takes care of middleware.
- `Network` - Handles the network layer. It is responsible for handling incoming connections and sending data to
  clients.
- `Communication` - Interprets incoming data and creates responses to send to clients.
- `Contracts` - Contains interfaces that are used by other modules to communicate with each other.

## Installation[¶](#installation "Permalink to this headline")
WIP

## A note about the database[¶](#a-note-about-the-database "Permalink to this headline")
Speedy uses Doctrine for database access. This means that you can use any database that is supported by Doctrine. 
However, Speedy is currently only tested with MySQL. If you want to use another database, you will have to make sure 
that it works with Speedy. If you find any issues, please report them. 

If you want to use another database, you will have to change the `driver` option in `config/app.php` to the driver that 
you want to use. You can find a list of supported drivers 
[here](https://www.doctrine-project.org/projects/doctrine-dbal/en/2.10/reference/configuration.html#driver).

You will also have to migrate the database to the new driver. You can do this by running the Doctrine migrations. You can
find more information about this [here](https://www.doctrine-project.org/projects/doctrine-migrations/en/2.2/reference/introduction.html).

#### Database pooling is current unsupported
Speedy currently does not support database pooling, like mature emulators do. This means that the database connection
will be closed after every request. This is not ideal, but it is not a problem for small emulators. If you want to use
Speedy for a large hotel, you will have to implement database pooling yourself. If you do this, please consider making a
pull request to add this feature to Speedy.

