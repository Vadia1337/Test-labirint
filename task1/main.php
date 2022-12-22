<?php
// для запуска данного файла в vs code используется зависимость php server.
// ВАЖНО get запрос идет от клиента(index.html) к серверу( по адресу http://localhost:3000/task1/main.php)
// в работе не стал использовать vue.js, сделал на чистом JS

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Europe/Moscow');

$currency= new Currency();
$curr = $currency->Get_Currencies();

$weather = new Weather();
$wea = $weather->Get_Weather();

echo json_encode([$curr, $wea], JSON_UNESCAPED_UNICODE);

// класс валют
class Currency{

    public function Get_Currencies(){

        $nowDate = Date('d/m/Y');
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.$nowDate);
        $json = json_encode($xml);
        $сurrencies = json_decode($json , true);

        $needed_currencies_id = array("R01235", "R01239", "R01770", "R01820", "R01350");
        /*
        где:
        Доллар США - R01235
        Евро - R01239
        Шведских крон - R01770
        Японских иен - R01820
        Канадский доллар - R01350
        */
        $found_currencies = array();

        for($i=0; $i < count($сurrencies['Valute']); $i++){
            $id = $сurrencies['Valute'][$i]['@attributes']['ID'];
            if(in_array($id, $needed_currencies_id)){
                $found_currencies[] = array(
                    'Name' => $сurrencies['Valute'][$i]['Name'],
                    'Code' => $сurrencies['Valute'][$i]['CharCode'],
                    'Value' => substr($сurrencies['Valute'][$i]['Value'],0,-2),
                );
            }
        }

        return $found_currencies;
    }


}

// класс погоды
class Weather{

    public static $city = "Moscow";
    public static $appid = "44129d2d29f44e478a21c3183ff76da8";

    public function Get_Weather(){

        $answer = json_decode(file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='.self::$city.'&appid='.self::$appid.'&lang=ru&units=metric'));


        $weather = array(
            'City' => $answer->name,
            'Date' => Date("d.m"),
            'Temp' => round($answer->main->temp),
            'Feels_like_temp' => round($answer->main->feels_like),
            'Description' => $answer->weather[0]->description,
        );
        return $weather;
    }

}

?>