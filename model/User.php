<?php 
class User { 
    private $email = ""; 
    private $password = ""; 
	private $pseudo = ""; 
    
    function setEmail($emailToSet) { 
        $this->email = $emailToSet; 
    }
	
	function getEmail() : string { 
        return $this->email; 
    }
	
	function hasEmail() : bool{
		return $this->email != null && $this->email != "";
	}
	
	function isEmailValid() : bool{
		return preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i", $this->email);
	}
	
	function setPseudo($pseudoToSet) { 
        $this->pseudo = $pseudoToSet; 
    }
	
	function getPseudo() : string { 
        return $this->pseudo; 
    }
	
	function hasPseudo() : bool{
		return $this->pseudo != null && $this->pseudo != "";
	}
	
	function isPseudoValid() : bool{
		return preg_match('`^([a-zA-Z0-9-_]{3,8})$`',$this->pseudo);
	}
	
	function setPassword($passwordToSet) { 
        $this->password = $passwordToSet; 
    }
	
	function getPassword() : string { 
        return $this->password; 
    }
	
	function hasPassword() : bool{
		return $this->password != null && $this->password != "";
	}
	
	function isPasswordValid() : bool{
		return preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $this->password);
	}
	
	function getAsJson() : string{
		return "{email:\"".$email."\",pseudo:\"".$pseudo."\",password:\"".$password."\"}";
	}
} 
?> 