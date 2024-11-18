## Descrizione

OpenEconomics – API Excercise

## Requisiti

Per installare il progetto è richiesto [Docker](https://www.docker.com/)

## Installazione

- Rinominare il file .env.example in .env
- Installare le dipendenze:

```
  docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php83-composer:latest \
  composer install --ignore-platform-reqs
```

- Avviare sail:

```
./vendor/bin/sail up -d
```

- generare l'APP_KEY nel file .env

```
./vendor/bin/sail artisan key:generate
```

- Eseguire le migration

```
./vendor/bin/sail artisan migrate
```

- Valorizzare nel file .env la variabile IUCN_TOKEN con il token di autenticazione

```
IUCN_TOKEN="<your_token>"
```

Nel progetto sono presenti 2 rotte:

- [http://localhost:8024/api/iucn/species/mammals](http://localhost:8024/api/iucn/species/mammals)
- [http://localhost:8024/api/iucn/species/critically-endangered](http://localhost:8024/api/iucn/species/critically-endangered)
