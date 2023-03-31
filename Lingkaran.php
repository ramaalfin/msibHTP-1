<?php 
require_once('Abstract.php');
class Lingkaran extends Bentuk2D {
    private $jari2;
    
    public function __construct($jari2) {
      $this->jari2 = $jari2;
    }
    
    public function namaBidang() {
      return "Lingkaran";
    }
    
    public function fungsiLuasBidang() {
      return number_format(pi() * $this->jari2 * $this->jari2, 2) . ' cm2';
    }
    
    public function fungsiKelilingBidang() {
      return number_format(2 * pi() * $this->jari2, 2) . ' cm';
    }
  }
