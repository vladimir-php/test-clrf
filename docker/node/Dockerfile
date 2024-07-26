FROM node:lts-alpine

WORKDIR /var/www

COPY package*.json ./

RUN npm install

CMD ["npm", "run", "dev"]