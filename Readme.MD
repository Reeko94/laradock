# Requirements

### -  Docker installed
### - Laravel >= 7
### - add volumes in the docker container which is using this package :
      - /var/run:/var/run
      - /var/lib/docker/:/var/lib/docker
### God mod on docker.sock file inside your docker container
      - chmod 777 /var/run/docker.sock

# Installation

```
- composer require 'scolabs/docker'
- Edit your config/app.php and add 'Scolabs\Docker\DockerServiceProvider::class' in providers array
```

# Usage

- To see all of your containers you can navigate to /containers
