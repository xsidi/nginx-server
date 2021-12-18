# nginx-server

Backup all the database on the host:
user@host:~/nginx-server$ docker exec nginx-server_mysql_1 /usr/bin/mysqldump -u root --password=secret --all-databases > mysql_dump_backup.sql