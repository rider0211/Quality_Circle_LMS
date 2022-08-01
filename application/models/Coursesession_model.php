<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Coursesession_model extends AbstractModel
{
    
    /**
     * This function used to manage accounting info
     */
   	protected $table;
   	protected $pay_table;
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'course_session';
    }
}

?>
