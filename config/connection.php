<?php
class KoneksiDB{
    function getKoneksi(){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "kantin";
        $konek = mysqli_connect($host, $user, $pass, $db) or die("Koneksi gagal" . mysqli_connect_error());
        if(mysqli_connect_errno()){
            exit();
        }
        return $konek;
    }
}