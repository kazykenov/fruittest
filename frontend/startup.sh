#!/bin/sh

# todo: check js folder recursive
find /usr/share/nginx/html/assets -name '*.js' -exec sed -i \
  -e 's,{{BACKEND_API_URL}},'"$BACKEND_API_URL"',g' \
  {} \;

nginx -g "daemon off;"