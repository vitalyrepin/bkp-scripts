#!/bin/sh

## Backing up of the home directory and MySQL database

tm=`date +%d.%m.%Y-%T`

# Mkdir for backup
mkdir $tm

cd
tar -cz cbtpod/ | gzip -9 > $tm/cbtpod.tgz
tar -cz tivitpod | gzip -9 > $tm/tivipod.tgz

# Backing tivitpod database
mysqldump  --single-transaction -u tivitpod -h localhost --password='PSW' tivitpod > $tm/tivitpod.sql
# Backing up cbtpod database
mysqldump  --single-transaction -u cbtpod -h localhost --password='PSW' cbtpod > $tm/cbtpod.sql

tar -cz $tm | gzip -9 > backup-$tm.tar.gz

rm -rf $tm

# Uploading backup file to the server
curl -u 'USER:PSW' -F "uploadedfile=@backup-$tm.tar.gz" https://HOST/bkppod/upload_bkp.php >> backup.log

rm -f backup-$tm.tar.gz

