<?php
class infoWeather{
    public $API;
    public $city;
    public function __construct($ApiKey,$city)
    {
        $this->API=$ApiKey;
        $this->city=$city;
    }
    private function getCoordinate(){
        $curl=curl_init("http://api.openweathermap.org/geo/1.0/direct?q={$this->city}&limit=5&appid=".$this->API);//получение координат
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $info=json_decode(curl_exec($curl),1);
        curl_close($curl);
        $data=[
            'lat'=>$info[0]['lat'],
            'lon'=>$info[0]['lon']
        ];
        return $data;
    }

    private function getInfoWeather(){
        $data=$this->getCoordinate();
        $weather=curl_init("https://api.openweathermap.org/data/2.5/weather?lat={$data['lat']}&lon={$data['lon']}&appid=".$this->API."&units=metric&lang=ru");//погода в цельсии

        curl_setopt($weather,CURLOPT_RETURNTRANSFER,1);

        $weatherall=json_decode(curl_exec($weather),1);

        curl_close($weather);

        $description=$weatherall['weather']['0']['description'];

        $temp=round($weatherall['main']['temp']);
        
        $feels_like=round($weatherall['main']['feels_like']);

        $wind=round($weatherall['wind']['speed']);

        $data=[
            'description'=>$description,
            'temp'=>$temp,
            'feel'=>$feels_like,
            'wind'=>$wind
        ];

        return $data;

    }

    public function mainInfo(){
        $data=$this->getInfoWeather();
        return $data;
    }
}

$cities=[
    'Москва'=>'Moscow',
    'Санкт-Петербург'=>'Saint Petersburg',
    'Казань'=>'Kazan',
    'Новосибирск'=>'Novosibirsk',
    'Владивосток'=>'Vladivostok'
];

$key=$_POST['city'];

$city=$cities[$key];

$api='2bd9390e4bf7249c2e9320671ea33b65';

$weather=new infoWeather($api,$city);

$result=$weather->mainInfo();

echo  'Погода в городе '.$key.' '.$result['description'].'</br>';

echo 'Температура '.$result['temp'].' градусов цельсия ощущается как '.$result['feel'].'</br>';

echo 'Скорость ветра:'.$result['wind'].' м/с';
?>