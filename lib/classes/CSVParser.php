<?php
/**
 * Description of csv_parser
 *
 * @author Neithan
 */
class CSVParser
{
	/**
	 * contains the gained data or the data to be saved as csv
	 * @var array
	 */
	private $csvData;

	/**
	 * contains the heading for the csv data
	 * @var array
	 */
	private $csvHeading;

	/**
	 * the handle for the csv file
	 * @var resource
	 */
	private $fileHandle;

	/**
	 * ths name of the csv file
	 * @var string
	 */
	private $fileName;

	/**
	 * contains the delimiter, enclosure and escape chars for the csv functions
	 * @var array
	 */
	private $csvParameters;

	/**
	 * if set, the csv file is empty
	 * @var boolean
	 */
	private $emptyFile;

	/**
	 * @param string $file a filename or path for the csv file
	 * @param array $parameters an array with the possible csv parameters
	 */
	function __construct($file = null, $parameters = array(), $noFile = false)
	{
		if (!$noFile)
		{
			if (!empty($file))
			{
				if(is_string($file))
				{
					$this->fileHandle = fopen($file, 'a+');
					$this->fileName = $file;
				}
				else
				{
					$this->fileHandle = $file;
					$this->fileName = '';
				}
			}
			else
			{
				$date = date('Y-m-d');
				$this->fileHandle = fopen($date.'.csv', 'a+');
				$this->fileName = $date.'.csv';
			}
		}
		else
		{
			$this->fileHandle = null;
			$this->fileName = null;
		}

		$this->csvData = array();
		$this->csvHeading = array();
		$this->csvParameters = $parameters + array(
			'delimiter' => ',',
			'enclosure' => '"',
			'escape' => '\\',
		);
		$this->emptyFile = true;
	}

	function __destruct()
	{
		if ($this->fileHandle)
			fclose($this->fileHandle);
	}

	/**
	 * set the parameters to the values given in the array, all parameters are optional
	 * if $parameters is empty nothing happens
	 * possible parameters: delimiter, enclosure, escape
	 * @param array $parameters
	 */
	function setCSVParameters($parameters)
	{
		$this->csvParameters = $parameters + $this->csvParameters;
	}

	/**
	 * return true on success
	 * @param array $data the data for csvData
	 * @param boolean $assoc if set to false, the entered array will get the keys of the csv, if csvHeading is filled
	 * @return boolean
	 */
	function setData($data, $assoc = true)
	{
		if ($data && ($assoc || !$this->csvHeading))
		{
			if (!$this->csvHeading)
				foreach ($data[0] as $key => $value)
					$this->csvHeading[] = $this->sanitize($key);

			$this->csvData = $data;
			return true;
		}
		elseif ($data && (!$assoc && $this->csvHeading))
		{
			$this->csvData = array();
			foreach ($data as $line)
				$this->csvData[] = array_combine($this->csvHeading, $line);
			return true;
		}
		return false;
	}

	/**
	 * sets a $data at $rowNumber or at the end
	 * @param array $data
	 * @param int $rowNumber
	 */
	function setRow($data, $rowNumber = null)
	{
		if ($rowNumber)
			$this->csvData[$rowNumber] = $data;
		else
			$this->csvData[] = $data;
	}

	/**
	 * set a heading for this csv file
	 * @param array $heading
	 */
	function setHeading($heading)
	{
		if (is_array($heading))
			$this->csvHeading = $heading;
	}

	/**
	 * fills the data array with a new line
	 * @param int $start defines the first line of the csv file
	 * @return boolean
	 */
	function parseCSV($start = null, $noHeading = null)
	{
		if (!$this->fileHandle)
			return false;
		else
		{
			$i = 0;
			while ($row = fgetcsv(
					$this->fileHandle,
					0,
					$this->csvParameters['delimiter'],
					$this->csvParameters['enclosure'],
					$this->csvParameters['escape']))
			{
				if ($start && $i < $start)
				{
					$i++;
					continue;
				}

				if (!$this->csvHeading && !$noHeading)
				{
					//removes trailing empty headlines
					for ($i = count($row) - 1; $i > 0; $i--)
					{
						if ($row[$i] === '')
							array_pop($row);
						else
							break;
					}

					foreach ($row as &$heading)
						$heading = $this->sanitize($heading);
					unset($heading);
					$this->csvHeading = $row;
				}
				else
				{
					if ($noHeading)
					{
						$this->csvData[] = $row;
					}
					else
					{
						//this is only for array_combine. if the length of the two arrays is not equal, it will throw an error.
						if (count($row) > count($this->csvHeading))
							$this->csvData[] = array_combine(array_merge($this->csvHeading, range(0, count($row) - count($this->csvHeading) - 1)), $row);
						else
							$this->csvData[] = array_combine($this->csvHeading, $row);
					}
				}

				if ($this->emptyFile)
					$this->emptyFile = false;

				$i++;
			}
			return true;
		}
	}

	/**
	 * write all stored data to the specified csv file
	 * if $file or the empty-file-flag is set there will be an new headline created
	 * @param string $file a filename or path for the csv file to write to
	 * @param array $heading if this is set, it will be used as heading for the csv file
	 * @param boolean $useHeading defines if the heading should be used for the csv file
	 * @return boolean
	 */
	function writeCSV($file = null, $heading = null, $useHeading = true)
	{
		if (!$heading)
			$heading = $this->csvHeading;

		if (!empty($file))
		{
			if (is_string($file))
				$handle = fopen($file, 'w');
			else
				$handle = $file;
		}
		elseif ($this->fileName)
			$handle = fopen($this->fileName, 'w');
		elseif ($this->fileHandle)
			$handle = $this->fileHandle;
		else
			return false;

		if (($file || $this->emptyFile) && $useHeading)
			fputcsv($handle, $heading, $this->csvParameters['delimiter'], $this->csvParameters['enclosure']);

		foreach ($this->csvData as $row)
			fputcsv($handle, $row, $this->csvParameters['delimiter'], $this->csvParameters['enclosure']);

		if ($file)
			fclose($handle);
		else
			rewind($handle);
		return true;
	}

	/**
	 * removes the specified characters, leading and trailing spaces from $string
	 * @param string $string
	 * @param array $replacements
	 * @return string
	 */
	private function sanitize($string, $replacements = array('*' => '', "\n" => ''))
	{
		return trim(strtr($string, $replacements));
	}

	/**
	 * returns the heading of the csv data
	 * @return array
	 */
	function getKeys()
	{
		return $this->csvHeading;
	}

	/**
	 * returns all data from the csv
	 * @return array
	 */
	function getData()
	{
		return $this->csvData;
	}

	/**
	 * returns the defined line
	 * @param int $row
	 * @return array
	 */
	function getRow($row)
	{
		return $this->csvData[$row];
	}

	/**
	 * returns the number of rows in csvData
	 * @return int
	 */
	function getNumberOfRows()
	{
		return count($this->csvData);
	}

	/**
	 * returns the stored data as a csv string
	 * @param array $headings if this is set, it will be used as heading for the csv string
	 * @param string $newLine define the new line character
	 * @param boolean $useHeading defines if the heading should be used
	 * @return string
	 */
	function getCSVString($headings = null, $newLine = "\n", $useHeading = true, $forceEnclosure = false)
	{
		$csvString = '';

		if ($useHeading)
		{
			if (!$headings)
				$headings = $this->csvHeading;
			else
			{
				foreach ($headings as &$heading)
					$heading = $this->sanitize ($heading);
				unset($heading);
			}

			$csvString .= $this->getCSVRow($headings, $newLine, $forceEnclosure);
		}

		foreach ($this->csvData as $row)
			$csvString .= $this->getCSVRow($row, $newLine, $forceEnclosure);

		return $csvString;
	}

	/**
	 * returns a formatted
	 * @param array $row the data that should be shown as csv
	 * @param string $newLine the new line character
	 * @return string
	 */
	private function getCSVRow($row, $newLine = "\n", $forceEnclosure = false)
	{
		$newRow = array();
		foreach ($row as $value)
		{
			if ((!is_numeric($value) && !empty($value)) || $forceEnclosure)
				$newRow[] = $this->csvParameters['enclosure'].str_replace($this->csvParameters['enclosure'], $this->csvParameters['escape'], $value).$this->csvParameters['enclosure'];
			else
				$newRow[] = $value;
		}

		return implode($this->csvParameters['delimiter'], $newRow).$newLine;
	}

	/**
	 * returns the used file handle
	 * @return resource
	 */
	function getFileHandle()
	{
		return $this->fileHandle;
	}

	/**
	 * get the name of the used csv file
	 * @return string
	 */
	function getFileName()
	{
		return $this->fileName;
	}
}