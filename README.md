# Bank REST API
Database RE-Diagram
![Screenshot](erd.png)

Fake load Command example
```
bin/console bank:load
```

Execute migration to crate tables and data
```
bin/console doctrine:migrations:migrate
```

Get all deposit accounts for a person
```
curl --location 'http://microbank/api/accounts/1'
```