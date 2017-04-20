FORMAT: 1A

# PULSAR ADMIN API 
Definición de la API del paquete pulsar-admin

## ADMIN API

# Group Langs
# Resources [/api/v1/admin/langs]

## Get all [GET /api/v1/admin/langs]

List all langs.

+ Request
    + Headers

            Content-Type: application/json
            
+ Response 200 (application/json)

    + Body

            {
                status: "success",
                data: [
                    {
                        id: "en",
                        name: "English",
                        icon: "gb",
                        sort: 0,
                        base: 0,
                        active: 1
                    },
                    {
                        id: "es",
                        name: "Español",
                        icon: "es",
                        sort: 1,
                        base: 1,
                        active: 1
                    }
                ]
            }
            
            
## Store [POST /api/v1/admin/langs]

Save lang.

+ Request
    + Headers

            Content-Type: application/json
            
    + Body
    
            {
                id: "en",
                name: "English",
                icon: "gb",
                sort: 0,
                base: 0,
                active: 1
            }

+ Response 200 (application/json)
    + Body

            {
                status: "success",
                data: {
                    id: "en",
                    name: "English",
                    icon: "gb",
                    sort: 0,
                    base: 0,
                    active: 1
                }
            }
            
+ Response 500 (application/json)
    + Body

            {
                status: "error",
                message: "Error description"
            }


## Get by id [GET /api/v1/admin/langs/{id}]

Gets a single lang by its unique identifier.

+ Parameters
    + id: `en` (string, required) - Unique identifier for a lang

+ Request
    + Headers

            Content-Type: application/json
    
+ Response 200 (application/json)
    + Body

            {
                status: "success",
                data: {
                    id: "en",
                    name: "English",
                    icon: "gb",
                    sort: 0,
                    base: 0,
                    active: 1
                }
            }
    
            
## Update [PUT /api/v1/admin/langs/{id}]

Update a single lang by its unique identifier.

+ Parameters
    + id: `en` (string, required) - Unique identifier for a lang

+ Request
    + Headers

            Content-Type: application/json
            
    + Body
        
                {
                    id: "en",
                    name: "English",
                    icon: "gb",
                    sort: 0,
                    base: 0,
                    active: 1
                }

+ Response 200 (application/json)
    + Body

            {
                status: "success",
                data: {
                    id: "en",
                    name: "English",
                    icon: "gb",
                    sort: 0,
                    base: 0,
                    active: 1
                }
            }
            
+ Response 500 (application/json)
    + Body

            {
                status: "error",
                message: "Error description"
            }
            
            
## Delete [DELETE /api/v1/admin/langs/{id}]

Delete a single lang by its unique identifier.

+ Parameters
    + id: `en` (string, required) - Unique identifier for a lang

+ Request
    + Headers

            Content-Type: application/json

+ Response 200 (application/json)
    + Body

            {
                status: "success",
                data: {
                    id: "en",
                    name: "English",
                    icon: "gb",
                    sort: 0,
                    base: 0,
                    active: 1
                }
            }
            
            
## Search [POST /api/v1/admin/langs/search]

Search elements.

+ Request
    + Headers

            Content-Type: application/json
            
    + Body
    
            {
                type: "query",
                lang: "en",
                parameters: [
                    {
                        command: "limit",
                        value: 10
                    },
                    {
                        command: "offset",
                        value: 0
                    },
                    {
                        command: "orderBy",
                        operator: "asc" // (asc | desc)
                        column: "id"
                    },
                    {
                        command: "orWhere",
                        column: "name"
                        operator: "like", // (like | = )
                        value: "Spanish"
                    }
                ]
            }
            

+ Response 200 (application/json)
    + Body

            {
                status: "success",
                filtered: 1,
                total: 4
                data: [
                    {
                        id: "es",
                        name: "Spanish",
                        icon: "es",
                        sort: 1,
                        base: 1,
                        active: 1
                    }
                ]
            }       
            


