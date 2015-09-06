<?php
//Обработчик событий

function message($input) 
{
    switch ($input['response']) 
    {
            // Ошибки при регистрации и авторизации
            
            
        case '100': //Пользователь с таким логином уже зарегистрирован!
            return '<div class="alert alert-dismissible alert-danger">
                  Пользователь с логином ' . $input['post']['login'] . ' уже зарегистрирован в системе!
                  </div>';
            break;

        case '110': //Пользователь с таким логином уже зарегистрирован!
            return '<div class="alert alert-dismissible alert-danger">
                  Пользователь с E-MAIL ' . $input['post']['email'] . ' уже зарегистрирован в системе!
                  </div>';
            break;

        case '120': //Пароль должен состоять минимум из 6-ти символов!
            return '<div class="alert alert-dismissible alert-danger">
                  Пользователь с логином jade уже зарегистрирован в системе!
                  </div>';
            break;

        case '130': //Заполните все поля!
            return '<div class="alert alert-dismissible alert-danger">
                  Для регистрации нужно заполнить все поля!
                  </div>';
            break;

        case '140': //Пользователь был успешно зарегистрирован!
            return '<div class="alert alert-dismissible alert-success">
                  Регистрация прошла успешно! Сейчас вы будете перенаправленны!
                  </div>';
            break;

        case '150': //Пароль долже состоять минимум из 6 символов
            return '<div class="alert alert-dismissible alert-danger">
                  Пароль должен состоять минимум из 6 символов!
                  </div>';
            break;

        case '160': //Запонитье все поля!
            return '<div class="alert alert-dismissible alert-danger">
                  Заполните обязательные поля!
                  </div>';
            break;

        case '170': //Логин должен состоять из английских букв и цифр 0-9!
            return '<div class="alert alert-dismissible alert-danger">
                  Логин должен состоять из английских букв и цифр 0-9!
                  </div>';
            break;

        case '172': //Логин может быть длинной от 3 символов!
            return '<div class="alert alert-dismissible alert-danger">
                  Логин должен содержать минимум 4 символа
                  </div>';
            break;

        case '174': //Логин может быть длинной до 30 символов!
            return '<div class="alert alert-dismissible alert-danger">
                  Логин должен содержать не более 30 символов
                  </div>';
            break;

        case '176': //Пароль может состоять из английских букв, цифр и символов \"? * - _ @ #\"!
            return '<div class="alert alert-dismissible alert-danger">
                  Пароль может состоять из английских букв, цифр и символов \"? * - _ @ #\"!
                  </div>';
            break;

        case '178': //Пароль может быть длинной от 7 символов!
            return '<div class="alert alert-dismissible alert-danger">
                  Пароль должен содержать минимум 7 символов
                  </div>';
            break;

        case '180': //Мыло не верно!!!!!!!!!!!1111!!!!!!
            return '<div class="alert alert-dismissible alert-danger">
                  Неверно заполнено поле E-Mail
                  </div>';
            break;

        case '182': //Мыло через чур длинное
            return '<div class="alert alert-dismissible alert-danger">
                  Поле E-Mail должно содержать в себе не более 12 символов
                  </div>';
            break;

        case '184': //Имя буквы
            return '<div class="alert alert-dismissible alert-danger">
                  Имя должено состоять из английских или русских букв и цифр 0-9!
                  </div>';
            break;

        case '186': //Имя короткое
            return '<div class="alert alert-dismissible alert-danger">
                  Имя должно содержать минимум 3 символа!
                  </div>';
            break;

        case '188': //Имя короткое
            return '<div class="alert alert-dismissible alert-danger">
                  Имя должно содержать максимум 30 символов!
                  </div>';
            break;

            // Ошибки при авторизации пользователя
            
            
        case '200':
            //Неправельный логин или пароль
            return 'Логин или пароль не верны!';
            break;
            // Общие пользовательские ошибки

        case '202':
            return 'Логин должен состоять из английских букв и цифр 0-9!';
            break;
            // Общие пользовательские ошибки

        case '204':
            return 'Логин должен содержать минимум 4 символа!';
            break;

        case '206':
            return 'Логин должен содержать максимум 30 символов!';
            break;

        case '208':
            return 'Пароль может состоять из английских букв, цифр и символов \"? * - _ @ #\"!';
            break;

        case '210':
            return 'Пароль должен содержать минимум 6 символов';
            break;

            // Общие пользовательские ошибки
            
        case '300':
            // Авторизируйтесь
            return '<div class="alert alert-dismissible alert-success">
	                Авторизируйтесь, что бы просматривать данную страницу.
	                </div>';
            break;

        case '310':
            // Данные о пользователе успешно обновлены
            return '<div class="alert alert-dismissible alert-success">
					Данные успешно обнолвенны.
					</div>';
            break;

        case '320':
            // Данные о пользователе НЕ обновлены
            return '<div class="alert alert-dismissible alert-danger">
					Ошибка.
					</div>';
            break;
            // Ошибки связанные с добавлением объявления!
            
            
        case '400':
            // Заполните все поля!
            return '<div class="alert alert-dismissible alert-danger">
					Заполните поля отмеченные звёздочкой (*)
					</div>';
            break;

        case '410':
            // Заполните все поля!
            return '<div class="alert alert-dismissible alert-danger">
					Объявление отправленно на одобрение модератором.
					</div>';
            break;

        case '420':
          # code...
          break;
    }
}
?>
