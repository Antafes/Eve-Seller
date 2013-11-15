<?php
/**
 * Description of EsPage
 *
 * @author Neithan
 */
abstract class Page
{
	/**
	 * @var Template
	 */
	protected $template;

	/**
	 * @param string $template The template file
	 */
	function __construct($template)
	{
		$this->template = new \Template();
		$this->template->setTemplate($template);
	}

	public function render()
	{
		$this->template->render();
	}

	public function getTemplate()
	{
		return $this->template;
	}

	abstract public function process();
}
