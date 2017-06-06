<?php

namespace PhpSolutions\File;


Class Upload {
    
    //defining the MIME Checking type
    protected $typeCheckingOn = true;
    public function allowAllTypes(){
    $this->typeCheckingOn = false;
    }
    
    protected $destination;
    protected $max = 51200;
    protected $messages = [];
    protected $permitted = [
        'image/gif', //image is used because that's the name used in the file <input> of the Html
        'image/jpeg',
        'image/pjpeg',
        'image/png',
    ];
    
    public function __construct($path){
        if(!is_dir($path) || !is_writable($path)){
            throw new \Exception("$path must be a valid, writable directory.");
    }
    $this->destination=$path; 
}

    public function upload(){
        $uploaded = current($_FILES);
        if($this->checkFile($uploaded)){
            $this->moveFile($uploaded);
        }
    }
    
    protected function checkFile($file){//preceeding the definition with the protected keyword means this method can be accessed only inside the class
        // return true;
        $accept = true;
        
        //$file['error'] means $_FILES['image']['error'], because normally, $file is been used as a top-level element in the $_FILES, wc mean $file = $_FILES['image']
        if($file['error'] != 0){
            $this->getErrorMessage($file);
            //stop checking if no file is submitted
            if(!$file['error'] == 4){
                return false;
            }
            else {
                $accept = false;
            }
        }
        
        if(!$this->checkSize($file)){
            $accept = false;
        }
        
        if($this->typeCheckingOn){
            if(!$this->checkType($file)){
                $accept = false;
            }
        }
        
        return $accept;
    }
    
    protected function getErrorMessage($file){
        switch($file['error']){
            case 1:
            case 2:
                $this->messages[] = $file['name']. ' is too big : (max : '. $this->getMaxSize(). ').';
                break;
            case 3:
                $this->messages[] = $file['name'] . ' was only partially uploaded.';
                break;
            case 4:
                $this->messages[] = ' No file Submitted';
                break;
            default :
                $this->messages[] = ' Sorry their was a problem loading ' . $file['name'];
                break;
        }
    }
    
    //defining the checkSize Method
    
    protected function checkSize($file){
        if($file['error'] == 1 || $file['error'] == 2){
            return false;
        }
        elseif($file['size'] == 0){
            $this->messages = $file['name'] . ' is an empty file.';
            return false;
        }
        elseif($file['size'] > $this->max){
            $this->messages[] = $file['name'] . ' excede the maximum size for a file ('.$this->getMaxSize().').';
            return false;
        }
        else{
            return true;
        }
    }
    
    //checking the file type
    
    protected function checkType($file) {
        if(in_array($file['type'], $this->permitted)){
            return true;
        }
        else{
            if(!empty($file['type'])){
            $this->messages[] = $file['name'] . ' is not a permitted type of file.';
            return false;
        }
    }
    }
    
    //definition to move the file to the selected path
    protected function moveFile($file){
        $success = move_uploaded_file($file['tmp_name'], $this->destination . $file['name']);
        if($success){
        $result = $file['name']. ' was uploaded successfully';
        $this->messages[] = $result;
        }
        else{
            $this->messages[] = 'Could not upload ' . $file['name'];
        }
    }
    
    //checking that the submitted value is a number and assign it to $max property
    public function setMaxSize($num){
        if(is_numeric($num) && $num > 0){
            $this->max = (int)$num;
        }
    }
   
    //converting raw number of bytes stored in $max into a friendlier format (MB)
    
    public function getMaxSize(){
        return number_format($this->max/1024, 1);
    }
    
    public function getMessages(){
        return $this->messages;
    }
}