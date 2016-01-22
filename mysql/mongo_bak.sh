#!/bin/bash
#################################
# Edit these to define source and destinations
MONGO_DBS=""
BACKUP_TMP=~/tmp
BACKUP_DESC=~/backups
MONGODUMP_BIN=/usr/bin/mongodump
TAR_BIN=/usr/bin/tar
##################################
BACKUPFILE_DATE=`date +%Y%m%d-%H%M`
#_do_store_archive <Database><Dump_dir><Dest_Dir><Dest_file>
function _do_store_archive{
	mkdir -p $3
	cd $2
	tar -cvzf $3/$4 dump
}

# _do_backup <Database name>
function _do_back{
	UNIQ_DIR="$BACKUP_TMP/$1"`date "+%s"`
	mkdir -p $UNIQ_DIR/dump
	echo "dumping Mongo Database $1"
	if ["all"="$1"];then
		$MONGODUMP_BIN -o $UNIQ_DIR/dump
	else
		$MONGODUMP_BIN -d $1 -o $UNIQ_DIR/dump
	fi
	KEY="database-$BACKUPFILE_DATE.tgz"
	echo "Archiving Mongo database to $BACKUP_DEST/$1/$KEY";
}