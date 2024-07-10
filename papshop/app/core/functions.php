<?php 

//this fucntion will show data to the frontend
function show($data)
{
        echo "<pre>";
        print_r($data);
        echo "</pre>";
}

//function check _error
function check_error()
{
        if(isset($_SESSION['error']) && $_SESSION['error'] != "" )
        {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
        }
}