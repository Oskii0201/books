<?php

namespace main;


class MainController{

    public function get_xml($save = 0){
        $file_name = 'books.json';
        if(file_exists($file_name)){
            unlink($file_name);
        }
        $xml_url = "https://dlabystrzakow.pl/xml/produkty-dlabystrzakow.xml";
        $data = @simplexml_load_file($xml_url);

        if ($data === false) {
            $data = @simplexml_load_file("produkty-dlabystrzakow.xml");

            if ($data === false) {
                die("Failed to load");
            }
        }

        $data = $this->prepare_file($data);
        if((int)$save === 1){
            $this->save_file($data);
        }
        file_put_contents($file_name,$data);
        return;
    }

    public function prepare_file($xml){
        if(empty($xml) || count($xml) < 1){
            die("Failed to load");
        }
        $books = array();
        foreach($xml->lista->children() as $book){
            $books[] = array(
                    "ident"=>(string)$book->ident,
                    "tytul"=>(string)$book->tytul[0],
                    "liczba_stron"=>(string)$book->liczbastron,
                    "data_wydania"=>(string)$book->datawydania
                    );
        }
        return json_encode($books);
    }

    function dd($var){
        echo '<pre>', var_dump($var), '</pre>';
        die();
    }
}

?>