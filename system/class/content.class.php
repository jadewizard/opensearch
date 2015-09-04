<?php
class ProjectContent
{
    public $data;
    public $avatarPath = null;
    /*
     * Функция для получения
     * Массива ВСЕХ объявлений
     * Из БД.
    */
    public function getAllAnnouncement() 
    {
        global $db, $twig;
        
        $this->data = $db->getAll('SELECT * FROM os_announcment');
        
        for ($i = 0; $i < count($this->data); $i++) 
        {
            $input_array = array_values($this->data[$i]); //Значения
            $input_array_keys = array_keys($this->data[$i]); //Ключи
            
            for ($a = 0; $a < count($input_array); $a++) 
            {
                if (empty($input_array[$a])) 
                {
                    $input_array[$a] = 'Не указанно';
                }
                //break;
            }
            
            $output_array[$i] = array_combine($input_array_keys, $input_array);
        }

        $twig->addGlobal('announceAll', $output_array);
    }
    /*
     * Функция для получения
     * Массива с контеном
     * Текущего (id) объявления
    */
    public function getThisAnnouncement($id) 
    {
        global $db, $twig;
        
        $this->data = $db->getAll('SELECT * FROM os_announcment WHERE id=' . $id . '');
        
        $input_array_keys = array_keys($this->data[0]); //Ключи
        $input_array = array_values($this->data[0]); //Значения
        
        for ($i = 0; $i < count($input_array); $i++) 
        {
            
            if (empty($input_array[$i])) 
            {
                $input_array[$i] = 'Не указанно';
            }
        }
        
        $output_array = array_combine($input_array_keys, $input_array);
        
        $twig->addGlobal('announceContent', $output_array);
        return $this->data[0];
    }
    
    public function addAnnouncement($announceDataArray) 
    {
        global $db, $site;
        
        $query = $db->query("INSERT INTO
         os_announcment 
         (title,
          annoucne_text,
          owner_id,
          program_language,
          action,
          project_language,
          team,
          host) VALUES
           ('$announceDataArray[announce_name]',
            '$announceDataArray[announce_text]',
            '$announceDataArray[owner_id]',
            '$announceDataArray[announce_planguage]',
            '$announceDataArray[announce_act]',
            '$announceDataArray[announce_language]',
            '$announceDataArray[announce_team]',
            '$announceDataArray[announce_host]')");
        
        if ($query == 1) 
        {
            return 410;
            header('Location: /index.php?announcement=' . $site->futureID('annoucne') . '');
        }
    }

    public function updateAnnounceInfo($contentInfoArray)
    {
        global $db;

        $photoPath = $this->avatarUpload($_FILES,$contentInfoArray['announce_id']);
        print_r($_FILES);

        $query = $db->query("UPDATE os_announcment SET
         title = '$contentInfoArray[new_announce_name]',
         annoucne_text = '$contentInfoArray[new_announce_text]',
         action = '$contentInfoArray[new_announce_act]',
         program_language = '$contentInfoArray[new_announce_planguage]',
         project_language = '$contentInfoArray[new_announce_language]',
         team = '$contentInfoArray[new_announce_team]',
         host = '$contentInfoArray[new_announce_host]',
         img = '$photoPath'
         WHERE id = '$contentInfoArray[announce_id]'");

        if ($query == 1)
        {
            return 310;
        }
        else
        {
            return 320;
        }
    }

    public function avatarUpload($data,$id)
    {
        global $db;

        print_r($data);

        if ($data['img']['error'] == 0)
        {
             if ($data['img']['size'] <> 25000000)
             {
                  if ($data['img']['type'] == "image/jpeg" ||
                      $data['img']['type'] == "image/png"  ||
                      $data['img']['type'] == "image/jpg" )
                  {
                       $extension = explode('.', $data['img']['name']); //Копируем расширение файла
                       $response = move_uploaded_file($data['img']['tmp_name'], 'system/projects/avatars/'.md5($extension[0]).'.'.$extension[1]);
                       
                       if ($response == true)
                       {
                            return 'system/projects/avatars/'.md5($extension[0]).'.'.$extension[1];
                       }

                  }
                  else
                  {
                       $url = $db->GetAll("SELECT img FROM os_announcment WHERE id='$id'");
                       return $url[0]['img'];
                  }
             } 
        }
    }
}

class UserContent
{
    public $data;
    
    public function getAllUser() 
    {
        global $db,$twig;
        
        $this->data = $db->getAll('SELECT * FROM os_user');
        
        for ($i = 0; $i < count($this->data); $i++) 
        {
            $input_array = array_values($this->data[$i]); //Значения
            $input_array_keys = array_keys($this->data[$i]); //Ключи
            
            for ($a = 0; $a < count($input_array); $a++) 
            {
                
                if (empty($input_array[$a])) 
                {
                    $input_array[$a] = 'Не указанно';
                }
                //break;
            }
            
            $output_array[$i] = array_combine($input_array_keys, $input_array);
        }
        
        $twig->addGlobal('allUserContent', $output_array);
    }
    
    public function getThisUser($id) 
    {
        global $db, $twig;
        
        $this->data = $db->getAll('SELECT * FROM os_user WHERE id=' . $id . '');
        
        $input_array_keys = array_keys($this->data[0]); //Ключи
        $input_array = array_values($this->data[0]); //Значения
        
        for ($i = 0; $i < count($input_array); $i++) 
        {
            
            if (empty($input_array[$i])) 
            {
                $input_array[$i] = 'Не указанно';
            }
        }
        
        $output_array = array_combine($input_array_keys, $input_array);
        
        $twig->addGlobal('userContent', $output_array);
        return $this->data[0];
    }
    /*
    Функция которая проверяте
    Залогинен ли юзер и возвращает
    шаблон который нужно показать.
    */
    public function GetUserCabinet($data) 
    {
        
        if (!empty($data['user_id'])) 
        {
            return 'cabinet.html';
            //Если есть user_id, то выводим кабинет   
        } 
        else
        { 
            return 'login.html';
            //Иначе форму логина      
        }
    }
    
    public function updateUserInfo($userInfoArray) 
    {
        
        global $db, $twig;

        $avatarPath = $this->avatarUpload($_FILES,$userInfoArray['user_id']);
        
        $query = $db->query("UPDATE os_user SET
         name = '$userInfoArray[new_name]',
         about = '$userInfoArray[new_about]',
         age = '$userInfoArray[new_age]',
         country = '$userInfoArray[new_country]',
         city = '$userInfoArray[new_city]',
         action = '$userInfoArray[new_action]',
         programm_language = '$userInfoArray[new_p_launguage]',
         language = '$userInfoArray[new_launguage]',
         p_url = '$userInfoArray[new_git]',
         avatar = '$avatarPath'
          WHERE id='$userInfoArray[user_id]'");
        
        if ($query == 1) 
        {   
            return 310;
            //Данные обновленны
        } 
        else
        { 
            return 320;
            //Данные не обновленны
        }
    }

    public function avatarUpload($data,$id)
    {
        global $db;

        if ($data['avatar']['error'] == 0)
        {
             if ($data['avatar']['size'] <> 25000000)
             {
                  if ($data['avatar']['type'] == "image/jpeg" ||
                      $data['avatar']['type'] == "image/png"  ||
                      $data['avatar']['type'] == "image/jpg" )
                  {
                       $extension = explode('.', $data['avatar']['name']); //Копируем расширение файла
                       $response = move_uploaded_file($data['avatar']['tmp_name'], 'system/users/avatars/'.md5($extension[0]).'.'.$extension[1]);
                       
                       if ($response == true)
                       {
                            return 'system/users/avatars/'.md5($extension[0]).'.'.$extension[1];
                       }

                  }
                  else
                  {
                       $url = $db->GetAll("SELECT avatar FROM os_user WHERE id='$id'");
                       return $url[0]['avatar'];
                  }
             } 
        }
    }

    public function getAnnounceCurrentUser($id)
    {
        global $db,$twig;

        $query = $db->getAll("SELECT * FROM os_announcment WHERE owner_id='$id'");

        $twig->addGlobal('currentUserAnnounce',$query);
    }
    
}
?>
