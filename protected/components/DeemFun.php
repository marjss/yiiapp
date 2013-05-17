<?php

class DeemFun extends CController
{
    
    /**
     * This function is to get all the Review status types
     */
    public function getReviewStatus(){
        return array(0=>'Deleted',1=>'Pending',2=>'Approved',3=>'Denied');
    }
}
?>
