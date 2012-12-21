<?php
namespace Vela\Bundle\IconsBundle\Command;

use Vela\Bundle\IconsBundle\CssGenerator\Generator;
use Vela\Bundle\IconsBundle\CssGenerator\GeneratorConfig;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CssGenerateCommand extends ContainerAwareCommand {
	/**
   * @var GeneratorConfig
	 */
	protected $arConfig;
	
	protected function configure() {
		parent::configure();
		
		$this->setName('vela:icons:generatecss')
			->addArgument('config_file',InputArgument::REQUIRED)
			->setDescription('Generate CSS file based on configuration file');
	}
	
	protected function initialize(InputInterface $input, OutputInterface $output) {
		$configFile = $input->getArgument('config_file');
		$path = realpath($configFile);
		if(!$path) {
			$output->writeln('<error>Configuration file '.$configFile.' not found.</error>');
			return true;
		}
		
		$this->arConfig = $this->getContainer()->get('serializer')->deserialize(file_get_contents($configFile),'Vela\Bundle\IconsBundle\CssGenerator\GeneratorConfig','json');
	}
	
	protected function execute(InputInterface $input, OutputInterface $output) {
		$gen = new Generator();
		$gen->generateCss($this->arConfig);
	}
}
?>
