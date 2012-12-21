<?php
namespace Vela\Bundle\IconsBundle\CssGenerator;
use JMS\Serializer\Annotation as JMS;

class IconSetConfig {
	/**
	 * 
	 * @var string
	 * @JMS\Type("string")
	 */
	protected $iconSetPath;

	/**
	 *
	 * @var string
	 * @JMS\Type("array<string>")
	 */
	protected $iconSetPatterns = array();
	
	/**
	 * @var string
	 * @JMS\Type("string")
	 */
	protected $iconSetPrefix;
	
	/**
	 * 
	 * @var string
	 * @JMS\Type("string")
	 */
	protected $outputFilename;

	/**
	 * 
	 * @return string
	 */
	public function getIconSetPath() {
		return $this->iconSetPath;
	}
	
	/**
	 * @return array
	 */
	public function getIconSetPatterns() {
		return $this->iconSetPatterns;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getIconSetPrefix() {
		return $this->iconSetPrefix;
	}

	/**
	 * 
	 * @return string
	 */
	public function getOutputFilename() {
		return $this->outputFilename;
	}
}
?>
