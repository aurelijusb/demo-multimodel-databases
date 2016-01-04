#/bin/bash

rm -fR arangodb*
rm -fR orientdb*/backup
rm -fR orientdb*/databases

for i in 1 2 3; do
  mkdir -p arangodb$i/arangodb
  mkdir -p arangodb$i/arangodb-apps
  mkdir -p arangodb$i/arangodb-foxxes
  mkdir -p arangodb$i/log

  mkdir -p orientdb$i/backup
  mkdir -p orientdb$i/databases

  chmod 777 -R arangodb$i
  chmod 777 -R orientdb$i
done

