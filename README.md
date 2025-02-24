# API - Tira Aí

Para rodar a aplicação localmente:
- Ajustar arquivo de configuração: `cp .env.example .env`
- Subir containers com as configs do env: `docker compose up -d`
- Conecte ao container do app: `docker compose exec app bash`
- Inicie os dados do banco: `php bin/hyperf.php app:seeder`