# Local Installation

These guides show how to use prepared Docker Compose configuration to simplify the installation process.
You do not need to install and configure the whole server stack (Nginx, PostgreSQL, etc.) in order to run and develop Shopsys Framework on your machine.

## How it works

All the services needed by Shopsys Framework like Nginx or PostgreSQL are run in Docker.
Your source code is automatically synchronized between your local machine and Docker container in both ways.

That means that you can normally use your IDE to edit the code while it is running inside a Docker container.

## Supported systems

- [Linux](installation-using-docker-linux.md)
- [MacOS](installation-using-docker-macos.md)
- [Windows 10 Pro and higher](installation-using-docker-windows-10-pro-higher.md)

## Installation without Docker

If your system is not listed above or you do not want to use Docker containers, do not worry, you can still install, develop and run Shopsys Framework natively by reading the following section.

First it is truly essential to read and understand the articles about requirements and configurations for Shopsys Framework application.
1. [Application Requirements](application-requirements.md)
1. [Application Configuration](application-configuration.md)
1. [Installation Troubleshooting](installation-troubleshooting.md)

After you read the articles you are ready to start with the creating and building the Shopsys Framework project.

### Create new project from Shopsys Framework sources

```
COMPOSER_MEMORY_LIMIT=-1 composer create-project shopsys/project-base --keep-vcs
cd project-base
```

*Notes:*
- *The `--keep-vcs` option initializes GIT repository in your project folder that is needed for diff commands of the application build and keeps the GIT history of `shopsys/project-base`.*
- *Since `v7.0.0-beta4` we have set the Composer memory limit to `-1` because of the increased memory consumption during the dependencies calculation.*
- *During the execution of `composer create-project`, there will be installed 3-rd party software as dependencies of Shopsys Framework by [composer](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) with licenses that are described in document [Open Source License Acknowledgements and Third-Party Copyrights](../../open-source-license-acknowledgements-and-third-party-copyrights.md)*

### Create databases

```
php phing db-create
php phing test-db-create
```

*Note: In this step you were using multiple Phing targets.
More information about what Phing targets are and how they work can be found in [Console Commands for Application Management (Phing Targets)](/docs/introduction/console-commands-for-application-management-phing-targets.md)*

### Build application

```
php phing build-demo-dev
```

***Note:** During the execution of `build-demo-dev phing target`, there will be installed 3-rd party software as dependencies of Shopsys Framework by [composer](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) and [npm](https://docs.npmjs.com/about-the-public-npm-registry) with licenses that are described in document [Open Source License Acknowledgements and Third-Party Copyrights](../../open-source-license-acknowledgements-and-third-party-copyrights.md)*

### Run integrated HTTP server

```
php bin/console server:run
```

*Note: you will be prompted for starting one of the 2 localised domains*  
*Note: you can use Nginx service instead of integrated server, in that case let be inspired by [nginx configuration](../../project-base/docker/nginx/nginx.conf)*

### See it in your browser!

Open [http://127.0.0.1:8000/](http://127.0.0.1:8000/) to see running application.

You can also login into the administration section on [http://127.0.0.1:8000/admin/](http://127.0.0.1:8000/admin/) with default credentials:
* Username: `admin` or `superadmin` (the latter has access to advanced options)
* Password: `admin123`
