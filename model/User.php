<?php 
class User { 
    private $email; 
    private $password; 
	private $pseudo; 
	private $validEmail;
	private $validPseudo;
	private $validPassword;

	
	
	public function __construct(){
		$ctp = func_num_args();
		$args = func_get_args();
		switch($ctp)
		{
			case 2:
				$this->setPseudo($args[0]);
				$this->setPassword($args[1]);
				break;
			case 3:
				$this->setEmail($args[0]);
				$this->setPseudo($args[1]);
				$this->setPassword($args[2]);
				break;
			default:
				$this->email = "";
				$this->pseudo = "";
				$this->password = "";
				break;
		}
	}
    
	public function isValidForRegister () : bool {
		return $this->validEmail && $this->validPseudo && $this->validPassword;
	}
	
	public function isValidForConnect () : bool {
		return $this->validPseudo && $this->validPassword;
	}
	
    public function setEmail($emailToSet) { 
        $this->email = $emailToSet;
		$this->validateEmail();
    }
	
	public function getEmail() : string { 
        return $this->email; 
    }
	
	public function hasEmail() : bool{
		return $this->email != null && $this->email != "";
	}
	
	private function validateEmail(){
		$this->validEmail = ($this->hasEmail() && preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i", $this->email));
	}
	
	public function isValidEmail() : bool{
		return $this->validEmail;
	}
	
	public function setPseudo($pseudoToSet) { 
        $this->pseudo = $pseudoToSet; 
		$this->validatePseudo();
    }
	
	public function getPseudo() : string { 
        return $this->pseudo; 
    }
	
	public function hasPseudo() : bool{
		return $this->pseudo != null && $this->pseudo != "";
	}
	
	private function validatePseudo(){
		$this->validPseudo = $this->hasPseudo() && preg_match('`^([a-zA-Z0-9-_]{3,8})$`',$this->pseudo);
	}
	public function isValidPseudo() : bool{
		return $this->validPseudo;
	}
	
	public function setPassword($passwordToSet) { 
        $this->password = $passwordToSet; 
		$this->validatePassword();
    }
	
	public function getPassword() : string { 
        return $this->password; 
    }
	
	public function hasPassword() : bool{
		return $this->password != null && $this->password != "";
	}
	
	private function validatePassword(){
		$this->validPassword = $this->hasPassword() && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $this->password);
	}
	
	public function isValidPassword() : bool{
		return $this->validPassword;
	}
	
	public function getAsJson() : string{
		return "{email:\"".$this->email."\",pseudo:\"".$this->pseudo."\",password:\"".$this->password."\"}";
	}
} 
?> 