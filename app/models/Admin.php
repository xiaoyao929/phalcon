<?php


class Admin extends BaseModel
{
	public $create_time;
	public $update_time;

	public function beforeCreate()
    {
        $this->create_time = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        $this->update_time = date('Y-m-d H:i:s');
    }

     public function beforeValidation()
    {
        if($this->isNew()){
    		$this->create_time = date('Y-m-d H:i:s');
    	}
    	$this->update_time = date('Y-m-d H:i:s');
    	return $this;
    }



    public function beforeSave(){
    	if($this->isNew()){
    		$this->create_time = date('Y-m-d H:i:s');
    	}
    	$this->update_time = date('Y-m-d H:i:s');
    	return $this;
    }
}