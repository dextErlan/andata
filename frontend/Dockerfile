FROM node:lts-alpine

WORKDIR /usr/app
COPY package*.json ./
RUN npm install

EXPOSE 8000

CMD ["npm", "run", "dev"]