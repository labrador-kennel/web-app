# Labrador Web App

A project skeleton for creating web apps using Labrador, a web app framework built on top of [Amphp]() packages and [Annotated Container](). This project template provides a [Docker]() image for running your app in development using [Docker Compose]() and in production using your preferred hosting provider. In addition, several libraries and configurations that are common in Labrador apps are provided, including, but not limited to&hellip;

- A [Postgresql]() database, connected to with [amphp/postgres]()
- Database migrations setup with [doctrine/migrations]()
- Templating system using [league/plates]() and a basic HTML5 layout
- Static asset serving with [amphp/http-server-static-content]()
- Configuration and secrets management using [cspray/annotated-container-secrets]()
- Run tasks with [casey/just]()

