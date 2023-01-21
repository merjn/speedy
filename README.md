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
