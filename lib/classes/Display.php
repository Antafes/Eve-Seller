<?php
/**
 * Description of EsPage
 *
 * @author Neithan
 */
class Display
{
	protected $unallowedPages = array(
		'Header',
	);

	public function showPage($pageName)
	{
		$pageName = $this->checkPage($pageName);

		// Create the page itself
		$class = '\\Page\\'.$pageName;
		$page = new $class();

		if ($page->getTemplate())
		{
			// Create the page header
			$header = new \Page\Header($page->getTemplate());
			$header->process();
		}

		$page->process();
		$page->render();
	}

	protected function checkPage($pageName)
	{
		if (in_array($pageName, $this->unallowedPages))
			return 'Index';
		else
			return $pageName;
	}
}
