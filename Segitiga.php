<?php 
class Segitiga extends Bentuk2D {
    private $alas;
    private $tinggi;
    
    public function __construct($alas, $tinggi) {
      $this->alas = $alas;
      $this->tinggi = $tinggi;
    }
    
    public function namaBidang() {
      return "Segitiga";
    }
    
    public function fungsiLuasBidang() {
      return 0.5 * $this->alas * $this->tinggi . ' cm2';
    }
    
    public function fungsiKelilingBidang() {
      return number_format($this->alas + 2 * sqrt(($this->alas/2) ** 2 + $this->tinggi ** 2)) . ' cm';
    }
  }
