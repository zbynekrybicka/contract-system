# Contract system

The application is a demonstration of a clear full-stack architecture that includes both a backend and a frontend.

## BackEnd

The [backend](backend) is built on a PHP/Symfony framework. It includes controllers, repositories and entities. The [controllers](backend/src/Controller) accept REST API requests and use the repositories to process these requests.

The [repositories](backend/src/Repository) have access to a MySQL database through a Doctrine layer and use the entities for data processing. Note: The repositories
uses an EntityManager for access to the database and other layers (for example JWT). Only the repositories have access to these layers, not by the controllers.

The [entities](backend/src/Entity) are objects contain database rows. You can send or receive the entities across the layers. The entities are adapted for specific purposes. They not contain getters and setters for all attributes. However all entity methods have to have specific purpose and they have to be covered by a [test](backend/tests/Entity).

## FrontEnd

The [frontend](frontend) is built with React + Redux. It includes React components, Redux reducers and API services. All layers are strictly spearated and each has a specific purpose.

The [components](frontend/src/components) are visual structure of the application. Their purpose is to conditionally render of the DOM, nothing else. All application logic is separated and only used inside these templates.

The [reducers](frontend/src/store) act as local data containers. They contain getters and setters for specific purposes and are covered by tests. They also contain data types for more complex data structures and these structures can be used in API services.

The [API services](frontend/src/services/api) are a contact layer with REST API and contain predefined API requests for communication with backend.

## Working Directories

### BackEnd

- [Controllers](backend/src/Controller) - handles and processes of HTTP requests
- [Repositories](backend/src/Repository) - manages access to the database and other data sources
- [Entities](backend/src/Entity) - Doctrine entities for database migrations and data processing

- [HTTP tests](backend/tests/http) - Acceptance tests calls fully process HTTP requests
- [Repository tests](backend/tests/Repository) - Integration tests calls the server sources
- [Entity tests](backend/tests/Entity) - Unit tests for checking entity methods

### FrontEnd

- [Components](frontend/src/components) - visual building blocks of the application
- [Store](frontend/src/store) - centralized state management and direct access to application data
- [Services/API](frontend/src/services/api) - modules responsible for sending HTTP methods

- [Components tests](frontend/tests/components) - Cypress tests for checking React components with store provider. (They don't call any API requests)
- [Store tests](frontend/tests/store) - Unit tests for checking getters and setters in all reducers
- [E2E](frontend/tests/e2e) - End-to-end tests veryfying complete application functionality


## First install

1. `git clone ...`
2. Execute script `install-backend` in [scripts](scripts)
3. Check the Adminer on http://localhost:8080 (`appuser:apppass@mysql/contract_system`)
4. Execute script `setup-db` in [scripts](scripts)
5. Go to [frontend](frontend)
6. `npm install`

## Execution after install

1. Execute script `start-backend` in [scripts](scripts)
2. Go to [frontend](frontend)
3. `npm run dev`

Don't forget if you want to close the backend, execute script `stop-backend` in [scripts](scripts)