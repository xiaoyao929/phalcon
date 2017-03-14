<?php


use \Phalcon\Mvc\Model;


class BaseModel extends Model
{
	public $new = true;

	public function afterFetch()
    {		
        if ( isset($this) ){
        	$this->new = false;
        }
        return $this->new;
    }

    public function isNew(){
    	return $this->new;
    }
	
}