<?php
class Cars 
{
    public $color;
    public $price;

    public function newColor($color) 
    {
        return $this->color = $color;
    }
}

$toyota = new Cars;
$toyota->color = 'black';
$toyota->price = 300;

$bmw = new Cars;
$bmw->price = 600;
$bmw->newColor('green');


class Television 
{
    public $mark;
    private $diagonal;
    
    function __construct($model, $diagonal) {
        $this->model = $model;
        $this->diagonal = $diagonal;
    }

    public function newDiagonal($diagonal) 
    {
        return $this->diagonal = $diagonal;
    }
}

$sony = new Television('BraviaE455', '60 дюймов');
$samsung = new Television ('UE58NU7100U', '65 дюймов');
echo $sony->newDiagonal('70 дюймов');
echo $samsung->mark . ' ' . $samsung->newDiagonal('65 дюймов');
echo PHP_EOL;
      

class BallPen
{
    private $color;
    private $openClick;
    
    function __construct($color, $openClick) {
        $this->color = $color;
        $this->openClick = $openClick;
    }

    
    public function displayColor()
    {
        return $this->color;
    }
    
    public function displayOpenClick()
    {
        return $this->openClick;
    }
}

$erickKrauseR521 = new BallPen('Синяя', 'Да');
$erickKrauseR301 = new BallPen('Черная', 'Нет');
echo $erickKrauseR521->displayColor() . ' ' . $erickKrauseR521->displayOpenClick();
echo $erickKrauseR301->displayColor() . ' ' . $erickKrauseR301->displayOpenClick();
echo PHP_EOL;

class Duck
{
    public $type;
    private $description;
    
    function __construct($type) {
        $this->type = $type;
    }

    
    public function addDescription ($newdescription)
    {
        return $this->description .= $newdescription;
    }
}

$duck1 = new Duck('Кряква');
$duck2 = new Duck('Серая утка');
$duck1->addDescription('Самая популярная для охотников');

echo $duck1->type . ' - ' . $duck1->addDescription(', местами ее называют также крякуша, крыжень, матерая утка, качка.');
echo PHP_EOL;

class Goods
{
    public $id;
    private $price;
    private $persent;
    
    function __construct($id, $price) {
        $this->id = $id;
        $this->price = $price;
    }

    
    public function discount($persent)
    {
        $this->price -= $this->price * (int)$persent/100;
        return $this->price . 'руб.';
    }
}

$bread = new Goods(1,'15 руб.');
$bear = new Goods(2, '50 руб.');

echo $bear->id . ' - Cтарая:' . $bear->discount(0) . ' Новая:' . $bear->discount('40%');