<?php // Class Bases File

class MonkeeUser{
	public $firstName = '';
	public $lastName = '';
	
	#does not work
	#public $fullName = $firstName . ' ' .  $lastName;
	
	#this is a getter
	public function getFullName(){
		return $this->firstName . ' ' .  $this->lastName;
	}
	
	#here the getter is used to create a personalized welcome
	public function sayHello(){
		return 'Hello ' . $this->getFullName() . '!';
	}




} //END MonkeeUser