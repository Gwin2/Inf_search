@echo off
docker compose up -d --build
start http://127.0.0.1:8080/index.html
