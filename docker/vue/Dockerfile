FROM node:18-alpine

WORKDIR /app

COPY ./frontend/package*.json ./

RUN npm install --legacy-peer-deps

COPY ./frontend .

RUN npx eslint --fix src/**/*.vue src/**/*.js

EXPOSE 8080

CMD ["npm", "run", "serve"]
