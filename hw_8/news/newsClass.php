<?php
class NewsClass 
{
    private $name;
    private $new;
    private $folder = 'addnews1';


//    function __construct($name, $new)        
//    {
//        $this->name = $name;
//        $this->new = $new;
//    }
    
    public function addNews($name, $new)
    {
        $this->name = $name;
        $this->new = $new;
        $date = date("Y.m.d_H.i.s");
        $dataArray = ['date' => $date, 'name' => $name, 'new' => $new];
        file_put_contents('./' . $this->folder . '/' . $date . '.json', json_encode($dataArray));
    }
    
    private function getJsonList() 
    {
        $files = scandir('./' . $this->folder);
        foreach ($files as $file) 
        {
            if (preg_match ('~\.json$~',$file)) 
            {
                $listFile[] = $file;
            }
        }
        return $listFile;
    }


    public function displayNews() 
    {
        if (empty($this->getJsonList())) {
            http_response_code(404);
            exit('Нет новостей');
        }
        foreach ($this->getJsonList() as $nameFile) 
        {
           $filename = './' . $this->folder . '/' . $nameFile;
           $file = json_decode(file_get_contents($filename), true);
           $fileArray[] = $file;
        }
        return $fileArray;
    }
    
    public function getComment($nameFile, $nameCom, $comment)
    {
        $nameFile = $nameFile;
        $date = date("Y.m.d_H.i.s");
        $fileArray = ['dateCom'=>$date, 'nameCom'=>$nameCom, 'comment'=>$comment];
        file_put_contents('./' . $this->folder . '/' . $nameFile . 'comment' . $date . '.json', json_encode($fileArray));
    }
}

class Comments
{
    
}
