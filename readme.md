# Contract system

The application is a demonstration of a clear full-stack architecture that includes both a backend and a frontend.

## BackEnd

The [backend](backend) is built on a PHP/Symfony framework. It includes controllers, repositories and entities. The controllers accept REST API requests and use the repositories to process these requests.

The repositories have access to a MySQL database through a Doctrine layer and use the entities for data processing. Note: The repositories
uses an EntityManager for access to the database and other layers (for example JWT). Only the repositories have access to these layers, not by the controllers.

The entities are objects contain database rows. You can send or receive the entities across the layers. The entities are adapted for specific purposes. They not contain getters and setters for all attributes. However all entity methods have to have specific purpose and they have to be covered by a test.

## FrontEnd
