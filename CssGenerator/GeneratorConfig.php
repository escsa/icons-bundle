<?php
namespace Vela\Bundle\IconsBundle\CssGenerator;

class GeneratorConfig {
	protected $iconSetPrefix;
	protected $iconSetPath;
	protected $iconSetPattern = array();
	
	public function getIconSetPrefix() {
		return $this->iconSetPrefix;
	}	
	
	public function getIconSetPath() {
		return $this->iconSetPath;
	}
	
	public function getIconPattern() {
		if(empty($this->iconSetPattern)) {
			return array('.+');
		}
		
		return $this->iconPattern;
	}
}
?>
