#/bin/bash

CONTAINERS=`docker ps | awk '{split($0,a,/ /); print a[1]}' | grep -v "CONTAINER"`

for CONTAINER in $CONTAINERS; do
	echo "Removing container: $CONTAINER"
	docker rm -f $CONTAINER
done;
