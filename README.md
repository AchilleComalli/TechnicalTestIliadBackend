# Utilizzo delle API di CodeIgniter 4

Questo progetto può essere eseguito su Docker.

## Prerequisiti

1.  Docker e Docker Compose installati sulla tua macchina.
2. Questo progetto CodeIgniter 4 sulla tua macchina.

## Costruire e Avviare i Container

 Dalla root del progetto, costruisci e avvia i container Docker con il comando:

```bash
docker-compose up --build
```

### Questo comando avvia due container:

Web container: L'applicazione CodeIgniter 4.

Database container: Un database MySQL configurato per l'applicazione.

## Creazione e Migrazione del Database

### Una volta che i container sono in esecuzione, dovrai eseguire manualmente i comandi per creare il database e le tabelle tramite le migrazioni e i seeder.

1. Accedi al Container dell'Applicazione
2. Esegui le Migrazioni -
   Una volta all'interno del container, esegui le migrazioni per creare le tabelle nel database:

    ```bash
    php spark migrate --all
   ```
3. Esegui il Seeding - Questo comando popolerà il database con i dati di esempio dei prodotti.

    ```bash
   php spark db:seed "Modules\Products\Database\Seeds\SeederProducts"
   ```

Una volta avviato il tutto, l'applicazione sarà accessibile all'indirizzo http://localhost:8080.
