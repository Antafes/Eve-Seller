<?php
namespace Page;

/**
 * Description of EsHeader
 *
 * @author Neithan
 */
class Header extends \Page
{
	/**
	 * @param \Template $template
	 */
	public function __construct($template)
	{
		$this->template = $template;
	}

	public function process()
	{
		// Add CSS files
		$this->template->loadCss('header');
		$this->template->loadCss('common');

		// Add JS files
		$this->template->loadJs('jquery-2.0.3');
		$this->template->loadJs('header');

		$this->createMenu();
		$language = \Model\Language::getLanguageById(\Translator::getUserLanguage());
		$this->template->assign('languageCode', $language->getIso2code());
	}

	protected function createMenu()
	{
		if ($_SESSION['userId'])
		{
			$user = \User::getUserById($_SESSION['userId']);
			$this->template->assign('isAdmin', $user->getAdmin());
		}
	}
}
