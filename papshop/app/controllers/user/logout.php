<?php

    // Public default method index, even if the user does or does not specify a URL, the Index will always run
    class logout extends Controller
{
    
    public function index()
    {
        // Load model logout 
        $User = $this->load_model('User');
        $User->logout();
    }
}
