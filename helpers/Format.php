<?php
    class Format{
    	public function formatDate($date){
           return date('D, j F, Y, g:i a', strtotime($date));
    	}

    	public function readMore($text, $limit=300){
            $text = $text." ";
            $text = substr($text,0, $limit);
            $text = substr($text,0, strrpos($text, ' '));
            return $text = $text." .....";
    	}

        public function validation($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            //$title = str_replace('_', ' ', $title); 
            // for Duble name like contact_us
            if ($title == 'index') {
                $title = 'home';
            }elseif ($title == 'contact') {
                $title = 'contact';
            }
            return $title = ucwords($title);
        }
    }

?>