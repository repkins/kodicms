<?php defined('SYSPATH') or die('No direct access allowed.');


class Layout
{
	public $name;
	
	private $_content;
	private $file;
	
	public static $mimes = array(
		'hqx'   =>  'application/mac-binhex40',
		'cpt'   =>  'application/mac-compactpro',
		'doc'   =>  'application/msword',
		'bin'   =>  'application/macbinary',
		'dms'   =>  'application/octet-stream',
		'lha'   =>  'application/octet-stream',
		'lzh'   =>  'application/octet-stream',
		'exe'   =>  'application/octet-stream',
		'class' =>  'application/octet-stream',
		'psd'   =>  'application/octet-stream',
		'so'    =>  'application/octet-stream',
		'sea'   =>  'application/octet-stream',
		'dll'   =>  'application/octet-stream',
		'oda'   =>  'application/oda',
		'pdf'   =>  'application/pdf',
		'ai'    =>  'application/postscript',
		'eps'   =>  'application/postscript',
		'ps'    =>  'application/postscript',
		'smi'   =>  'application/smil',
		'smil'  =>  'application/smil',
		'mif'   =>  'application/vnd.mif',
		'xls'   =>  'application/vnd.ms-excel',
		'ppt'   =>  'application/vnd.ms-powerpoint',
		'wbxml' =>  'application/vnd.wap.wbxml',
		'wmlc'  =>  'application/vnd.wap.wmlc',
		'dcr'   =>  'application/x-director',
		'dir'   =>  'application/x-director',
		'dxr'   =>  'application/x-director',
		'dvi'   =>  'application/x-dvi',
		'gtar'  =>  'application/x-gtar',
		'php'   =>  'application/x-httpd-php',
		'php4'  =>  'application/x-httpd-php',
		'php3'  =>  'application/x-httpd-php',
		'phtml' =>  'application/x-httpd-php',
		'phps'  =>  'application/x-httpd-php-source',
		'js'    =>  'application/x-javascript',
		'swf'   =>  'application/x-shockwave-flash',
		'sit'   =>  'application/x-stuffit',
		'tar'   =>  'application/x-tar',
		'tgz'   =>  'application/x-tar',
		'xhtml' =>  'application/xhtml+xml',
		'xht'   =>  'application/xhtml+xml',
		'zip'   =>  'application/zip',
		'mid'   =>  'audio/midi',
		'midi'  =>  'audio/midi',
		'mpga'  =>  'audio/mpeg',
		'mp2'   =>  'audio/mpeg',
		'mp3'   =>  'audio/mpeg',
		'aif'   =>  'audio/x-aiff',
		'aiff'  =>  'audio/x-aiff',
		'aifc'  =>  'audio/x-aiff',
		'ram'   =>  'audio/x-pn-realaudio',
		'rm'    =>  'audio/x-pn-realaudio',
		'rpm'   =>  'audio/x-pn-realaudio-plugin',
		'ra'    =>  'audio/x-realaudio',
		'rv'    =>  'video/vnd.rn-realvideo',
		'wav'   =>  'audio/x-wav',
		'bmp'   =>  'image/bmp',
		'gif'   =>  'image/gif',
		'jpeg'  =>  'image/jpeg',
		'jpg'   =>  'image/jpeg',
		'jpe'   =>  'image/jpeg',
		'png'   =>  'image/png',
		'tiff'  =>  'image/tiff',
		'tif'   =>  'image/tiff',
		'css'   =>  'text/css',
		'html'  =>  'text/html',
		'htm'   =>  'text/html',
		'shtml' =>  'text/html',
		'txt'   =>  'text/plain',
		'text'  =>  'text/plain',
		'log'   =>  'text/plain',
		'rtx'   =>  'text/richtext',
		'rtf'   =>  'text/rtf',
		'xml'   =>  'text/xml',
		'xsl'   =>  'text/xml',
		'mpeg'  =>  'video/mpeg',
		'mpg'   =>  'video/mpeg',
		'mpe'   =>  'video/mpeg',
		'qt'    =>  'video/quicktime',
		'mov'   =>  'video/quicktime',
		'avi'   =>  'video/x-msvideo',
		'movie' =>  'video/x-sgi-movie',
		'doc'   =>  'application/msword',
		'word'  =>  'application/msword',
		'xl'    =>  'application/excel',
		'eml'   =>  'message/rfc822'
	);
	
	public function __construct( $layout_name = '' )
	{
		$this->name = $layout_name;
		
		$this->file = LAYOUTS_SYSPATH.$layout_name.EXT;
	}
	
	public function __get($key)
	{
		if (method_exists($this, $key))
			return $this->{$key}();
	}
	
	public function __set($key, $value)
	{
		if ($key == 'content')
		{
			$this->_content = $value;
		}
	}
	
    public static function findAll()
    {
		$layouts = array();
		
		$layouts_dir = opendir(LAYOUTS_SYSPATH);
		
		while ($layout_file = readdir($layouts_dir))
		{
			if (is_file(LAYOUTS_SYSPATH.$layout_file) && substr($layout_file, -strlen(EXT)) == EXT)
			{
				$layouts[] = new Layout(substr($layout_file, 0, strrpos($layout_file, EXT)));
			}
		}
		
		return $layouts;
    }
    
    public function isUsed()
    {
        return Record::countFrom('Page', 'layout_file=?', array($this->name));
    }
	
	public function content()
	{
		if ($this->_content === null)
			if (file_exists($this->file))
				$this->_content = file_get_contents($this->file);
			else
				$this->_content = '';
		
		return $this->_content;
	}

	public function save()
	{
		$new_file = LAYOUTS_SYSPATH.$this->name.EXT;
		
		if ( $new_file != $this->file )
		{			
			rename($this->file, $new_file);
			$this->file = $new_file;
		}
		
		$f = fopen($this->file, 'w+');
		$result = fwrite($f, $this->_content);
		fclose($f);
		
		return ($result === FALSE ? FALSE : true);
	}
	
	public function delete()
	{		
		return unlink($this->file);
	}
	
	public function isExists()
	{
		return file_exists($this->file);
	}
    
} // end Layout class