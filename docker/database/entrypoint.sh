#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "postgres" <<-EOSQL
    CREATE DATABASE app_test;
    GRANT ALL PRIVILEGES ON DATABASE app_test TO app;
EOSQL