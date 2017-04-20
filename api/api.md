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
                    },
                    ...
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
               
               
# Group Countries
# Resources [/api/v1/admin/countries]
               
## Get all [GET /api/v1/admin/countries/{lang}]
               
List all countries, you can filter by lang.

+ Parameters
    + lang: `en` (string, optional) - Unique identifier for a lang
               
+ Request
    + Headers
               
            Content-Type: application/json
                           
+ Response 200 (application/json)

    + Body

            {
                status: "success",
                data: [
                    {
                        id: "AD",
                        name: "Andorra",
                        icon: "de",
                        sort: 0,
                        base: 0,
                        active: 1,
                        lang_id: "de",
                        prefix: "376",
                        territorial_area_1: "Gemeinden",
                        territorial_area_2: "",
                        territorial_area_3: "",
                        data_lang: "{"langs":["es","en","fr","de"]}",
                        data: null,
                        country_id: "AD",
                        country_name: "Andorra",
                        lang_name: "Deutsch"
                   },
                   {
                        id: "AE",
                        name: "Vereinigte Arabische Emirate",
                        icon: "de",
                        sort: 0,
                        base: 0,
                        active: 1,
                        lang_id: "de",
                        prefix: "971",
                        territorial_area_1: null,
                        territorial_area_2: null,
                        territorial_area_3: null,
                        data_lang: "{"langs":["es","en","fr","de"]}",
                        data: null,
                        country_id: "AE",
                        country_name: "Vereinigte Arabische Emirate",
                        lang_name: "Deutsch"
                   },
                   {
                        id: "AF",
                        name: "Afghanistan",
                        icon: "de",
                        sort: 0,
                        base: 0,
                        active: 1,
                        lang_id: "de",
                        prefix: "93",
                        territorial_area_1: "Provinzen",
                        territorial_area_2: "",
                        territorial_area_3: "",
                        data_lang: "{"langs":["es","en","fr","de"]}",
                        data: null,
                        country_id: "AF",
                        country_name: "Afghanistan",
                        lang_name: "Deutsch"
                   },
                   ...
                ]
            }
            
            
## Store [POST /api/v1/admin/countries]

Save country.

+ Request
    + Headers

            Content-Type: application/json
           
    + Body
   
            {
                id: "AA",
                lang_id: "en",
                name: "Country Test",
                prefix: "00",
                sort: 0,
                territorial_area_1: "",
                territorial_area_2: "",
                territorial_area_3: ""
            }

+ Response 200 (application/json)
    + Body

            {
                status: "success",
                data: {
                    id: "AA",
                    lang_id: "en",
                    name: "Country Test",
                    prefix: "00",
                    sort: 0,
                    territorial_area_1: "",
                    territorial_area_2: "",
                    territorial_area_3: "",
                    data_lang:"{\"langs\":[\"en\"]}"
               }
            }
           
+ Response 500 (application/json)
    + Body

            {
               status: "error",
               message: "Error description"
            }
            
            
## Get by id [GET /api/v1/admin/countries/{id}/{lang}]

Gets a single lang by its unique identifier.

+ Parameters
    + id: `AD` (string, required) - Unique identifier for a country
    + lang: `en` (string, required) - Unique identifier for filter by lang

+ Request
    + Headers

            Content-Type: application/json
   
+ Response 200 (application/json)
    + Body

            {
                status: "success",
                data: {
                    id: "AD",
                    name: "Andorra",
                    icon: "gb",
                    sort: 0,
                    base: 0,
                    active: 1,
                    lang_id: "en",
                    prefix: "376",
                    territorial_area_1: "Parishes",
                    territorial_area_2: "",
                    territorial_area_3: "",
                    data_lang: "{"langs":["es","en","fr","de"]}",
                    data: null,
                    country_id: "AD",
                    country_name: "Andorra",
                    lang_name: "English"
                }
            }
            
            
## Update [PUT /api/v1/admin/countries/{id}/{lang}]

Update a single lang by its unique identifier.

+ Parameters
    + id: `US` (string, required) - Unique identifier for a country
    + lang: `en` (string, required) - Unique identifier for filter by lang

+ Request
    + Headers

            Content-Type: application/json
           
    + Body
       
            {
                id: "AA",
                lang_id: "en",
                name: "Country Test",
                prefix: "00",
                sort: 0,
                territorial_area_1: "",
                territorial_area_2: "",
                territorial_area_3: ""
            }

+ Response 200 (application/json)
    + Body

            {
               status: "success",
               data: {
                   id: "AD",
                   name: "Country Test",
                   sort: 0,
                   active: 1,
                   lang_id: "en",
                   prefix: "00",
                   territorial_area_1: "",
                   territorial_area_2: "",
                   territorial_area_3: "",
                   data_lang: "{"langs":["es","en","fr","de"]}",
                   data: null
               }
            }
           
+ Response 500 (application/json)
    + Body

            {
               status: "error",
               message: "Error description"
            }
                
                
## Delete [DELETE /api/v1/admin/countries/{id}/{lang}]

Delete a single lang by its unique identifier.

+ Parameters
    + id: `AA` (string, required) - Unique identifier for a country
    + lang: `en` (string, optional) - Unique identifier for filter by lang

+ Request
    + Headers

            Content-Type: application/json

+ Response 200 (application/json)
    + Body

            {
                status: "success",
                data: {
                    id: "AA",
                    name: "Test",
                    icon: "es",
                    sort: 0,
                    base: 0,
                    active: 1,
                    lang_id: "en",
                    prefix: "00",
                    territorial_area_1: "",
                    territorial_area_2: "",
                    territorial_area_3: "",
                    data_lang: "{"langs":["es","en","fr","de"]}",
                    data: null,
                    country_id: "AA",
                    country_name: "Test",
                    lang_name: "English"
                }
            }
            
            
## Search [POST /api/v1/admin/countries/search]

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
                        id: "AD",
                        name: "Andorra",
                        icon: "de",
                        sort: 0,
                        base: 0,
                        active: 1,
                        lang_id: "de",
                        prefix: "376",
                        territorial_area_1: "Gemeinden",
                        territorial_area_2: "",
                        territorial_area_3: "",
                        data_lang: "{"langs":["es","en","fr","de"]}",
                        data: null,
                        country_id: "AD",
                        country_name: "Andorra",
                        lang_name: "Deutsch"
                    },
                    {
                        id: "AE",
                        name: "Vereinigte Arabische Emirate",
                        icon: "de",
                        sort: 0,
                        base: 0,
                        active: 1,
                        lang_id: "de",
                        prefix: "971",
                        territorial_area_1: null,
                        territorial_area_2: null,
                        territorial_area_3: null,
                        data_lang: "{"langs":["es","en","fr","de"]}",
                        data: null,
                        country_id: "AE",
                        country_name: "Vereinigte Arabische Emirate",
                        lang_name: "Deutsch"
                    },
                    {
                        id: "AF",
                        name: "Afghanistan",
                        icon: "de",
                        sort: 0,
                        base: 0,
                        active: 1,
                        lang_id: "de",
                        prefix: "93",
                        territorial_area_1: "Provinzen",
                        territorial_area_2: "",
                        territorial_area_3: "",
                        data_lang: "{"langs":["es","en","fr","de"]}",
                        data: null,
                        country_id: "AF",
                        country_name: "Afghanistan",
                        lang_name: "Deutsch"
                    },
                    ...
                ]
            }
            
           
         
           
           

            


