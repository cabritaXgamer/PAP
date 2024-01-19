<?php
class home 
{
    public function index()
        {
            echo "BATATAS  de teste  this is the home class inside index method";

        }
        public function view()
        {

        }
}

class number2 extends home 
{
    public function index()
        {
            $this->view();
        }
}