# Requirements

### -  Docker installed
### - Laravel >= 7
### - add volumes in the docker container which is using this package :
      - /var/run:/var/run
      - /var/lib/docker/:/var/lib/docker
### God mod on docker.sock file
      - chmod 777 /var/run/docker.sock

# Installation
```shell script
composer require 'scolabs/docker'
```

# Usage

- To see all of your containers you can navigate to /containers
