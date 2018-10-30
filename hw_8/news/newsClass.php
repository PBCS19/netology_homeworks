<?php
class NewsClass 
{
    private $name;
    private $new;
    
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
        file_put_contents('./addnews/' . $date . '.json', json_encode($dataArray));
    }
    
    private function getJsonList() 
    {
        $files = scandir('./addnews');
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
        foreach ($this->getJsonList() as $nameFile) 
        {
           $filename = './addnews/' . $nameFile;
           $file = json_decode(file_get_contents($filename));
           $fileArray[] = $file;
        }
        return $fileArray;
    }
}
