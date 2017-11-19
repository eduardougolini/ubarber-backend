php app/console doctrine:mapping:convert yaml ./src/AppBundle/Resources/config/doctrine/metadata/orm --from-database --force

php app/console doctrine:mapping:import AppBundle annotation
php app/console doctrine:generate:entities AppBundle --no-backup
