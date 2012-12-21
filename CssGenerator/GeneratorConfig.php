<?php
namespace Vela\Bundle\IconsBundle\CssGenerator;
use JMS\Serializer\Annotation as JMS;

class GeneratorConfig {
	/**
	 * 
	 * @var string
	 * @JMS\Type("string")
	 */
	protected $basePath;

	/**
   * @var array<Vela\Bundle\IconsBundle\CssGenerator\IconSetConfig>
   * @JMS\Type("array<Vela\Bundle\IconsBundle\CssGenerator\IconSetConfig>")
	 */
	protected $sets = array();

	public function getBasePath() {
		return $this->basePath;
	}

	public function setBasePath($basePath) {
		$this->basePath = realpath($basePath);
	}

	public function getSets() {
		return $this->sets;
	}
	
	/**
	 * 
	 * @param IconSetConfig $config
	 * @return bool
	 */
	public function addSet(IconSetConfig $config) {
		if(!in_array($config, $this->sets)) {
			$this->sets[] = $config;
			
			return true;
		}
		
		return false;
	}
	
	/**
	 * 
	 * @param mixed $key
	 */
	public function removeSet($key) {
		if(key_exists($key,$this->sets)) {
			unset($this->sets[$key]);
		}
	}
	
	/**
	 * @JMS\PostDeserialize
	 */
	public function postDeserialize() {
		$this->basePath = realpath($this->basePath);
	}
}
?>
