# EPAM_Project
Проект сторений у рамках IT-марафону компанії EPAM.

Тематикою проекту є електронна черга для запису до лікаря.

Проект розміщений на хмарному сервісі AWS за посиланням http://52.90.105.113/.

Опис сторінок та файлів виконаних у рамках проекту:

1) 404.php - сторінка, що відображається у тому випадку, коли шукана сторінка не знайдена.
![alt text](Description/404.png) 
2) closedStatus.php - сторінка з інформуванням про успішність закриття заявки оператором чи адміністратором (не доступна звичайним та неавторизованим  користувачам).
![alt text](Description/operator_closedStatus.png) 
3) exit.php - вихід користувачів з системи.
![alt text](Description/exit.png) 
4) history.php - перегляд заявок у системі, можливість їх фільтрації та відправки переглянутих заявок у обробку (останнє тільки для адміністраторів та операторів).
![alt text](Description/not_authorized_history.png) 
![alt text](Description/authorized_history.png) 
![alt text](Description/operator_history.png) 
5) index.php - головна сторінка на якій можуть ввести свої дані для відправлення заявки як авторизовані клієнти так і не авторизовані.
![alt text](Description/not_authorized_index.png) 
![alt text](Description/authorized_index.png) 
6) panel.php - сторінка для вибору користувача, якому буде підвищена або понижена роль у системі (доступна тільки адміністраторам ресурсу).
![alt text](Description/admin_panel.png) 
7) requestStatus.php - сторінка з інформуванням про успішність відправлення заявки у обробку оператором чи адміністратором системи та можливістю закриття заявки (не доступна звичайним та неавторизованим  користувачам).
![alt text](Description/operator_requestStatus.png)
8) role-change.php - сторінка для інформуванням успішності зміни ролі користувача системи адміністратором.
![alt text](Description/admin_role-change.png)
9) success.php - сторінка з інформуванням про успішність відправки заявки у обробку.
![alt text](Description/success.png)
11) /scripts/reg/reg.php - сторінка з перевіркою форми авторизації та занесенню відповідних даних до бази.
![alt text](Description/not_authorized_reg-status.png)
12) /scripts/reg/reg-form.php - сторінка з формою для реєстрації користувачів.
![alt text](Description/not_authorized_reg-form.png)
![alt text](Description/not_authorized_reg-form-new.png)
13) /scripts/auth/auth.php - сторінка з перевіркою форми авторизації та при відповідності даних входу у систему.
![alt text](Description/not_authorized_auth-status.png)
14) /scripts/auth/auth_form.php - сторінка з формою для авторизації користувачів.
![alt text](Description/not_authorized_auth-form.png)
![alt text](Description/not_authorized_auth-form-new.png)
15) config.php - файл, що зберігає основні змінні, що визначають основні параметри роботи додатку.
16) script.js - файл, що зберігає команди js, що використовуються у проекті.
17) /style/style.css - головний файл css стилів, що були використані у проекті.
18) /scripts/bd/bd.php - php файл, що зберігає параметри підключення до бази даних.
19) /scripts/func/funct.php - php файл, що зберігає функції, що застосовувалися у проекті.
20) /Assets/ - папка для графічних файлів, що використовувалися у пректі.
21) epamproject.sql - файл сценарію створення бази даних.
