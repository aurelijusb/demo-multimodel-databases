ArangoDB + OrinetDB + PHP example
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
docker-compose -f docker-compose.yml run multimodel
docker ps
```

You will see bindings to ports:

* http://0.0.0.0:45291
* http://0.0.0.0:45292
* http://0.0.0.0:45293
* http://0.0.0.0:24801
* http://0.0.0.0:24802
* http://0.0.0.0:24803

OrientDB web console: http://127.0.0.1:24801 with `root`:`rootpdw`

Useful docker commands:

```
docker ps -a
docker logs
./docker-remove-all.sh
docker rm `docker ps --no-trunc -aq`
docker rmi -f docker_multimodel
./clear-data.sh
```

Connecting to container
-----------------------

For debuging purposes, you can connect to existing container:
check environment and connection to other containers.

```
docker exec -i -t docker_arangodb3_1 bash
docker exec -i -t docker_orientdb3_1 bash
```

Useful commands inside container:

```
cat /etc/hosts
printenv
ip addr show

```

For debugging
-------------

Browsers can mess-up cookies when host is different only by port.
Recommended:
```
echo "127.0.0.1 orientdb1
127.0.0.1 orientdb2
127.0.0.1 orientdb3
127.0.0.1 arangodb1
127.0.0.1 arangodb2
127.0.0.1 arangodb3
" >> /etc/hosts
```

So you could access datbases (`root:rootpwd`) via:

* http://orientdb1:24801
* http://orientdb2:24802
* http://orientdb3:24803
* http://arangodb1:45291
* http://arangodb2:45292
* http://arangodb3:45293

References
----------

* https://docs.docker.com/compose/
* https://github.com/orientechnologies/orientdb-docker
* https://github.com/arangodb/arangodb-docker/tree/2.7
