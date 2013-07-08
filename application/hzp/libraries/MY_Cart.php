<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Cart extends CI_Cart {

    function  __construct() {
        
        parent::__construct();
        // Override product name rules because there really shouldn't be any rules
        // especially when no feedback is given to the customer!!
       $this->product_name_rules = '\d\D'; 
    }    
} 