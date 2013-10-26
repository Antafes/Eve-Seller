<?php
/**
 * Description of EsLanguage
 *
 * @author Neithan
 */
class Translator
{
	/**
	 * @var array
	 */
	protected $languages;

	/**
	 * @var integer
	 */
	protected $currentLanguage;

	/**
	 * @var array
	 */
	protected $translations;

	function __construct()
	{
		$this->fillLanguages();
		$this->fillTranslations();
	}

	/**
	 * Fetches all languages and adds them as EsModelLanguage to the language list.
	 */
	protected function fillLanguages()
	{
		$sql = '
			SELECT languageId
			FROM es_languages
			WHERE !deleted
		';
		$languages = query($sql, true);

		foreach ($languages as $language)
		{
			$this->languages[$language['languageId']] = \Model\Language::getLanguageById(
				$language['languageId']
			);
		}
	}

	/**
	 * Fetches all translations and adds them to the translation list.
	 */
	protected function fillTranslations()
	{
		/* @var EsModelLanguage $language */
		foreach ($this->languages as $language)
		{
			$sql = '
				SELECT `key`, `value`
				FROM es_translations
				WHERE languageId = '.sqlval($language->getLanguageId()).'
					AND !deleted
			';
			$translations = query($sql, true);

			foreach ($translations as $translation)
			{
				$this->translations[$language->getLanguageId()][$translation['key']]
					= $translation['value'];
			}
		}
	}

	/**
	 * Get all fetched languages.
	 *
	 * @return array
	 */
	public function getAllLanguages()
	{
		return $this->languages;
	}

	/**
	 * Get the id of the users language.
	 *
	 * @return integer
	 */
	public function getCurrentLanguage()
	{
		return $this->currentLanguage;
	}

	/**
	 * Set the language of the user
	 *
	 * @param integer $currentLanguage
	 */
	public function setCurrentLanguage($currentLanguage)
	{
		$this->currentLanguage = $currentLanguage;
		self::setUserLanguage($this->currentLanguage);
	}

	/**
	 * Get the translated name for the users language
	 *
	 * @return string
	 */
	public function getCurrentLanguageName()
	{
		return $this->getTranslation($this->languages[$this->currentLanguage]->getLanguage());
	}

	/**
	 * Get the translation for the given key. If there is no translation available, the key is
	 * returned.
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function getTranslation($key)
	{
		if (is_object($key) || is_bool($key))
			return $key;

		if (is_array($key))
		{
			foreach ($key as &$item)
				$item = $this->getTranslation($item);

			return $key;
		}

		if (array_key_exists($key, $this->translations[$this->currentLanguage]))
			return $this->translations[$this->currentLanguage][$key];
		else
			return $key;
	}

	/**
	 * @return integer
	 */
	public static function getUserLanguage()
	{
		$languageId = $_COOKIE['esLanguage'];

		if (!$languageId)
		{
			$iso2code   = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			$language   = self::getLanguageByIso2Code($iso2code);
			$languageId = $language->getLanguageId();
		}

		return $languageId;
	}

	/**
	 * @param integer $languageId
	 */
	public static function setUserLanguage($languageId)
	{
		setcookie('esLanguage', $languageId, time() + 86400);
	}
}
