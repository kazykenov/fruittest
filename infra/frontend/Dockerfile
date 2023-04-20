# build stage
FROM node:lts-alpine as build-stage
WORKDIR /app
COPY ./vue/package*.json ./
RUN npm install
COPY ./vue .
RUN npm run build

# production stage
FROM nginx:stable-alpine as production-stage
COPY ./startup.sh /app/
RUN chmod a+x /app/startup.sh
COPY ./default.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app/dist /usr/share/nginx/html

EXPOSE 80
CMD ["/app/startup.sh"]