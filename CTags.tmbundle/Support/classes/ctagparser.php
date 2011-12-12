<?php
/**
 */

/**
 */
class CTagParser
{
	/**
	 * Filename to open and parse.
	 *
	 * @var string $_filename
	 */
	protected $_filename;
	
	/**
	 * Tag cache, once the file has been parsed.
	 *
	 * @var array $_tags
	 */
	protected $_tags = array();
	
	/**
	 * Constructor.
	 *
	 * @param string $filename Optional filename to open and parse.
	 */
	public function __construct($filename = null)
	{
		if ($filename) {
			$this->setFilename($filename);
		}
	}
	
	/**
	 * Find a tag and return an array of where it's used.
	 *
	 * @param string $tag Tag to look for.
	 *
	 * @return mixed Array of tag info on success, or false.
	 */
	public function findTag($tag)
	{
		// Make sure the file has been parsed.
		$this->_parse();
		
		return array_key_exists($tag, $this->_tags)
			? $this->_tags[$tag]
			: false;
	}
	
	/**
	 * Find a class tags, returning an array of where it's used.
	 *
	 * @param string $class Class name to look for.
	 *
	 * @return mixed Array of tag info on success, or false.
	 */
	public function findClass($class)
	{
		if (($tags = $this->findTag($class)) === false) {
			return false;
		}
		
		// Loop over each found tag, fetching the class tags.
		$classes = array();
		foreach ($tags as $tag) {
			if ($tag->type == 'c') {
				$classes[] = $tag;
			}
		}
		
		// Return false if no classes found.
		return $classes ?: false;
	}
	
	/**
	 * Filename setter.
	 *
	 * @param string $filename Path to the file to parse.
	 *
	 * @return void
	 */
	public function setFilename($filename)
	{
		$this->_filename = $filename;
		
		// Flush the tags when the filename is changed.
		$this->_tags = array();
		
		// Check for cached tags.
		$this->_loadCache();
	}
	
	/**
	 * Save tags to the cache.
	 *
	 * @return void
	 */
	protected function _saveCache()
	{
		$cacheFileName = $this->_filename . '.cache';
		file_put_contents($cacheFileName, serialize($this->_tags));
	}
	
	/**
	 * Load up any cached tags.
	 *
	 * @return void
	 */
	protected function _loadCache()
	{
		$cacheFileName = $this->_filename . '.cache';
		
		if (file_exists($cacheFileName)) {
			$this->_tags = unserialize(file_get_contents($cacheFileName));
		}
	}
	
	/**
	 * Parse the tags file if not already loaded, and cache its tags.
	 *
	 * @param bool $force Force the file to be parsed, even if it's cached.
	 *
	 * @return void
	 */
	protected function _parse($force = false)
	{
		if (! $force && $this->_tags) {
			// There's already tags loaded, and we weren't forced.
			return;
		}
		
		// Clear the currently-cached tags.
		$this->_tags = array();
		
		// Open the file, obviously.
		$file = fopen($this->_filename, 'r');
		
		// Loop over each line in the file, processing each tag in turn.
		while ($line = fgets($file)) {
			if (! $line = trim($line)) {
				// Ignore blank lines.
				continue;
			}
			
			if (substr($line, 0, 6) == '!_TAG_') {
				// Ignore ctag comments.
				continue;
			}
			
			// Parse the line into an object.
			if (! $tag = $this->_parseLine($line)) {
				continue;
			}
			
			if (! array_key_exists($tag->name, $this->_tags)) {
				// Ensure there's an array for us to add to.
				$this->_tags[$tag->name] = array();
			}
			
			// Store the tag for later.
			$this->_tags[$tag->name][] = $tag;
		}
		
		// Always close the file.
		fclose($file);
		
		$this->_saveCache();
		
		/*
		$types = array();
		
		foreach ($this->_tags as $name => $tags) {
			foreach ($tags as $tag) {
				if (! array_key_exists($tag->type, $types)) {
					$types[$tag->type] = 0;
				}
				
				$types[$tag->type]++;
			}
		}
		*/
	}
	
	/**
	 * Parse the line into an object.
	 *
	 * @param string $line Raw line from the file.
	 *
	 * @return object Tag object representing the line.
	 */
	protected function _parseLine($line)
	{
		static $pattern = '/^(?P<name>[^\t]+)\t(?P<file>[^\t]+)\t(?P<pattern>\/.*?\/;")\t(?P<type>.)\t?(?P<other>.*)$/';
		
		if (! preg_match($pattern, $line, $matches)) {
			throw new Exception('Failed to match line: ' . $line);
		}
		
		return (object) array(
			'name' => $matches['name'],
			'file' => $matches['file'],
			'pattern' => $matches['pattern'],
			'type' => $matches['type'],
			'other' => $matches['other'],
		);
	}
}