<?php 
namespace Vela\Bundle\IconsBundle\CssGenerator;

use Symfony\Component\DependencyInjection\ContainerAware;

class Generator extends ContainerAware {
	public function generateCss(GeneratorConfig $config) {		
		if(!$config->getBasePath()) {
			return false;
		}
		
		$arResultFiles = array();
		foreach($config->getSets() as $setConfig) {
			$iconPath = $config->getBasePath() . '/' . $setConfig->getIconSetPath();
			if(!$iconPath) {
				return false;
			}
			
			$outputFilename = $setConfig->getOutputFilename();
			if(!key_exists($outputFilename, $arResultFiles)) {
				$arResultFiles[$outputFilename] = array();
			}
			 
			$arPatterns = $setConfig->getIconSetPatterns();
			$arPatterns = count($arPatterns) == 0 ? array('*') : $arPatterns;
			
			$fi = new \FilesystemIterator($iconPath,\FilesystemIterator::SKIP_DOTS);
			foreach($fi as $file) {
				foreach($arPatterns as $i=>$pattern) {
					if($pattern == '*' || preg_match('/' .$pattern. '/', $file->getFilename())) {
						$cls = $file->getBasename('.png');
						$line = sprintf(".%s-%s { background-image: url('../../%s/%s') !important }",$setConfig->getIconSetPrefix(),$cls,$setConfig->getIconSetPath(),$file->getFilename());
						$arResultFiles[$outputFilename][] = $line;
					}
				}
			}
	
			
			$outputDir = $dir = $config->getBasePath() . '/css';
			@mkdir($dir,0755,true);
			if(!is_dir($dir)) {
				return false;
			}
			
			foreach($arResultFiles as $filename=>$arStack) {
				sort($arStack);
				$result = $dir . ($config->getCustom() ? '/custom/' : '/buildin/') . $outputFilename;
				file_put_contents($result, implode("\n",$arStack));
			}
		}
	}
	
	private function getIconSetPath($basePath, IconSetConfig $config) {
		return realpath($basePath . '/' . $config->getIconSetPath());
	}
}
?>
