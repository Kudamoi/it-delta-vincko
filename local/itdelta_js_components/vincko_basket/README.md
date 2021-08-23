# vincko_basket
Компонент корзина для страниц карточка КОМПЛЕКТА ОБОРУДВАНИЯ и карточка ГОТОВОГО РЕШЕНИЯ

Внимание! Команды нужно запускать внутри директории компонента - /vincko_basket/
1. Подтягиваем зависимости с помощью команды npm install
2. Настравиаем путь деплоя в файле package.json, где devX площадка разработчика
```json
"deploy": "rollup -c; curl -k 'sftp://94.228.123.233/home/bitrix/ext_www/devX.vincko.market/local/templates/v_new_template/css/' --user 'login:password' -T 'public/build/basket.js' --ftp-create-dirs"
```
3. Вносим необходимые изменения в компонент
4. npm run deploy - для сборки компонента и деплоя на заданный удаленный сервер (см п.2)
