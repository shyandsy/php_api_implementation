# php_api_implementation
implement api from scratch using PHP

## Build Local Dev Environment

Start docker which contain nginx & php. I have mysql and redis on my machine, so I haven't put them into docker file.
If you need mysql and redis, just start docker container.   

1. build docker network, add add 
    ```shell
    # create a docker netwokr named devnet
    docker network create devnet
    
    # add mysql8, redis to docker network
    docker network connect devnet mysql8
    docker network connect devnet redis
    ```
2. run docker compose to start nginx and php

```shell
docker compose up -d --build
```

1. The root document for the php project src ./src
2. the service port is 8080

Now we can check browser http://localhost:8080/