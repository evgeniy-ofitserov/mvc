<?php 


function isAdmin()
{
    if( isset($_SESSION['user']) ){
        if($_SESSION['user'] == 'admin')  { 
            $resault = true;
        }else {
            $resault = false;          
        }
    }else{
        $resault = false;
    }
    return $resault;

}
?>