ArangoDB + OrientDB + PHP example
=================================

Prerequisites
-------------

* Installed docker: http://docs.docker.com/engine/installation/
* Installed docker compose: https://docs.docker.com/compose/install/

For example:

* `docker --version`: Docker version 1.9.1, build a34a1d5
* `docker-compose --version`: docker-compose version: 1.5.1

Running stack
-------------

```
docker-compose up -d

cd php/
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

You will see bindings to ports:

* http://0.0.0.0:45291
* http://0.0.0.0:45292
* http://0.0.0.0:45293
* http://0.0.0.0:24801
* http://0.0.0.0:24802
* http://0.0.0.0:24803
* http://0.0.0.0:8000

OrientDB web console: http://127.0.0.1:24801 with `root`:`rootpdw`

Useful docker commands:

```
docker ps
docker ps -a
docker logs
docker-compose logs
./docker-remove-all.sh
docker rm `docker ps --no-trunc -aq`
docker rmi -f docker_multimodel
./clear-data.sh
docker rm -f docker_multimodel_1 && docker-compose up -d && docker logs -f docker_multimodel_1
```

Connecting to container
-----------------------

For debuging purposes, you can connect to existing container:
check environment and connection to other containers.

```
docker exec -i -t docker_arangodb3_1 bash
docker exec -i -t docker_orientdb3_1 bash
docker exec -i -t docker_multimodel_1 bash
```

Useful commands inside container:

```
cat /etc/hosts
printenv
ip addr show
ps aux
```

For debugging
-------------

Browsers can mess-up cookies when host is different only by port.
Recommended:
```
echo "127.0.0.1 orientdb1.local
127.0.0.1 orientdb2.local
127.0.0.1 orientdb3.local
127.0.0.1 arangodb1.local
127.0.0.1 arangodb2.local
127.0.0.1 arangodb3.local
127.0.0.1 multimodel.local
" >> /etc/hosts
```

So you could access datbases (`root:rootpwd`) via:

* http://orientdb1.local:24801
* http://orientdb2.local:24802
* http://orientdb3.local:24803
* http://arangodb1.local:45291
* http://arangodb2.local:45292
* http://arangodb3.local:45293
* http://multimodel.local:8000

Usefull ArangoDB commands, snippets
-----------------------------------

```
arangosh --server.endpoint tcp://0.0.0.0:45293 --server.username root
```
```
db._collections()
db.Elements.toArray()
```

Usefull OrientDB commands, snippets
-----------------------------------

Create alias `orientdb-console` for `orientdb-community-2.1.5/bin/console.sh`
Inside console:

```
connect remote:0.0.0.0:24243/demo root rootpwd
list classes
browse class Elements
```

References
----------

* https://docs.docker.com/compose/
* https://github.com/orientechnologies/orientdb-docker
* https://github.com/arangodb/arangodb-docker/tree/2.7
* https://docs.docker.com/v1.8/compose/wordpress/
* http://stackoverflow.com/questions/25591413/docker-with-php-built-in-server
* https://github.com/docker-library/docs/blob/master/php/README.md
