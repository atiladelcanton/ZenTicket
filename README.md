zenTicket  Alpha
================

### Run Project

First let's define our user to avoid problems with permissions, in your terminal on your computer type :

```shell
 id -u && id -g
```
copy the result that gives in the terminal and replace in the docker-compose.yml

```yaml
 app:
    image: zenticket_oficial/zenticket_v2:latest
    user: "1001:1001" -- Change here
```
After create the .env file based on the .env.example

```shell
cp .env.example .env
```
Start container
```shell
docker-compose up -d --build #run this command if the first time
docker-compose up -d
```

After generating the .env run the command to create the image and install the dependencies!

```shell
docker-compose run --rm zenticket-app composer install
```