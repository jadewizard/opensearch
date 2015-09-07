<?php
/*
Класс для получения различной информации
нужной для работы сайта.
*/

class info
{
    //Функция для получения
    //Массива стран с помощью API VK.
    public function getCountries()
    {
    	global $twig; //Шаблонизатор

        $apiUrl = 'http://api.vk.com/method/database.getCountries?v=5.5&need_all=1&count=1000';

        $apiQuery = curl_init();

        curl_setopt($apiQuery, CURLOPT_URL,$apiUrl);
        curl_setopt($apiQuery, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($apiQuery, CURLOPT_HEADER, 0);

        $apiResponse = curl_exec($apiQuery);
        $responseArray = json_decode($apiResponse,true);

        $countriesArray = $responseArray['response']['items'];

        $twig->addGlobal('allCountries',$countriesArray);
        //Передаем шаблонизатору массив стран
    }
}