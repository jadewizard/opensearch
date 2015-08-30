<?php
//Обработчик событий

function message($input)
{
	switch ($input['response']) {

// Ошибки при регистрации и авторизации

		case '100': //Пользователь с таким логином уже зарегистрирован!
			return '<div class="alert alert-dismissible alert-danger">
                  Пользователь с логином '.$input['post']['login'].' уже зарегистрирован в системе!
                  </div>';
			break;

		case '110': //Пользователь с таким логином уже зарегистрирован!
			return '<div class="alert alert-dismissible alert-danger">
                  Пользователь с E-MAIL '.$input['post']['email'].' уже зарегистрирован в системе!
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

        case '160': //Пароль долже состоять минимум из 6 символов
			return '<div class="alert alert-dismissible alert-danger">
                  Заполните обязательные поля!
                  </div>';
			break;

// Ошибки при авторизации пользователя

        case '200':
            //Неправельный логин или пароль
        	return 'Логин или пароль не верны!';
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

	}
}

?>
