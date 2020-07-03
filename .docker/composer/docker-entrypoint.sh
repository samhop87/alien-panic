#!/bin/sh
set -e

chmod 700 /root/.ssh
chmod 600 /root/.ssh/id_rsa

exec composer "$@"
