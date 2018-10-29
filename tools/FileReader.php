<?php  
class FileReader { 
    private $filePath; 
	private $file;
	private $separateur;
    
	function __construct($filepath,$separateur){
		$this->filePath = $filepath; 
		$this->separateur = $separateur; 
	}
	
    function setFilePath($filePathToSet) { 
        $this->filePath = $filePathToSet; 
    }
	
	function getFilePath() { 
        return $this->filePath; 
    }
	
	function init(){
		// On ouvre le fichier ou on le crée s'il existe pas
		$this->file = fopen("".$this->filePath, 'a+');
	}
	
	function destroy(){
		// Fermeture du fichier 
		fclose($this->file);
	}
	
	function find($element, $position, $element2, $position2){
		$this->init();
		while(!feof($this->file)) {
			//Lecture d'une ligne
			$line = fgets($this->file);
			//Separation de la ligne sur le charactere ','
			$splittedLine = explode($this->separateur, $line);
			if(isset($splittedLine[$position])){
				$Element = trim($splittedLine[$position]);
				//Test de la présence de l'email en deuxième position de la ligne
				if ($Element == $element){
					$this->destroy();
					if ($element2 != null && $element2 != ""){
						if ($element2 != trim($splittedLine[$position2])){
							return false;
						}
					} return true;
				} 
			}
		}
		$this->destroy();
		return false;
	}
	
	function write ($line){
		$this->init();
		fputs($this->file,$line);
		$this->destroy();
	}
} 
?> 