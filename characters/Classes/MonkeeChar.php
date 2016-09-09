<?php // MonkeeChar.php

class MonkeeChar{
	public $str             = '';
	
	//management
	public $userID          = '';
	public $dateCreated     = 'NOW';
	
	
//moves to config
	
	public $dateUpdated     = 0;
	
	public $charID          = '';
	public $codeName        = '';
	public $firstName       = '';
	public $lastName        = '';
	public $image           = '';
	public $gender          = 0;
	public $playby          = ''; #actor cast in part
	public $power           = ''; #name of power
	public $powerDesc       = ''; #description of power
	public $team            = '';
	public $teamPosition    = '';
	
	
	
	
	#does not work
	#public $fullName = $firstName . ' ' .  $lastName;
	
	#my getters
	public function getTitle(){
		/* 
		 * we might only have one of the three possibilities, 
		 * so go with order of importance 
		*/
		
		if(!empty($this->codeName)){
			$str = '<h3>Character Profile: ' . $this->codeName . 
				' - ID:' 
			. $this->charID . '</h3>';
		}else if(!empty($this->lastName) && !empty($this->firstName)){
			$str = '<h3>Character Profile: ' . $this->lastName . ', ' . 
				$this->firstName . ' - ID:' 
			. $this->charID . '</h3>';
		}else if(!empty($this->lastName)){
			$str = '<h3>Character Profile: ' . $this->lastName . 
				' - ID:' 
			. $this->charID . '</h3>';
		}else if(!empty($this->firstName)){
			$str = '<h3>Character Profile: ' . $this->firstName . 
				' - ID:' 
			. $this->charID . '</h3>';
		}else{
			$str = '<h3>Character Profile: PROFILE NOT NAMED - ID:' 
			. $this->charID . '</h3>';
		}		
		return $str;
	}
		
	public function getImage(){ #will need to come array handler
	#for now...
	if(!empty($this->playby)){
		$str .= '<img src="../uploads/' . $this->playby . '.jpg" /><br /><br />';
	}else{
		$str .= '<i>no image</i><br /><br />';
	}
	return $str;
}
	
	public function getFullName(){
		if(!empty($this->lastName) && !empty($this->firstName)){
			$str = 'Name: ' . $this->lastName . ', ' . 
				$this->firstName . '<br />';
		}else if(!empty($this->lastName)){
			$str = 'Name: ' . $this->lastName . '<br />';
		}else if(!empty($this->firstName)){
			$str = 'Name: ' . $this->firstName . '<br />';
		}else if(!empty($this->codeName)){
			$str = $this->codeName . ' has no known name. <br />';
		}else{
			$str = 'Character has no known name. <br />';
		}		
		return $str;
	}
	
	public function getGender(){
		if($this->gender > 0){
			$str = 'Sex: Male <br />';
		}else{
			$str = 'Sex: Female <br />';
		}
		return $str;
	}

	public function getPlayby(){
	if(!empty($this->playby)){
		$str = 'Playby: ' . $this->playby . '<br />';
	}
	return $str;
}
	
	public function getPowers(){ #will need to come array handler
		#for now...
		if(!empty($this->power)){
			$str = '<b>Powers</b>: <i>' .
				$this->power . ':</i> ' . $this->powerDesc . '<br />';
		}
		return $str;
	}
	
	public function getTeam(){ #will need to come array handler
	#for now...
	if(!empty($this->team)){
		if(!empty($this->teamPostion)){
			$str = 'Team: Is a member of: <i>' . $this->team;
		}else{
			$str = 'Team: Is the ' . $this->teamPosition . ' of: <i>' . $this->team;
		}
	}
	return $str;
}
	
	public function getDateModified(){
	 return $str = '<br />' . $this->dateUpdated . '<br />';
  }

	
	#here the getter is used to create a personalized welcome
	public function getProfile(){
		
		#ultimately, we will want to loop this, use the keys to 
		$temp  = $this->getTitle(); #method starts article
		
		$temp .= $this->getImage();
		
		$temp .= '<br /><p>';	
		$temp .= $this->getFullName(); #method makes full name
		$temp .= $this->getGender();
		$temp .= $this->getPlayby();
		$temp .= $this->getPowers();
		$temp .= $this->getTeam();
		$temp .= $this->getDateModified();
		

			
		$temp .= '<br /></p>';
		return $temp;
	}
	
} //END MonkeeUser





