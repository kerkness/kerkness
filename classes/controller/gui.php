<?php 

class Controller_Gui extends Controller
{
	public function action_media()
	{
		$file = $this->strip_extension($this->request->param('file'), $this->request->param('type') );
		$this->display_file( $file, $this->request->param('type') );
	}
	
	protected function display_file( $file, $ext ){
		// set header
		header('Content-Type: ' . Kohana::config("mimes.$ext") );
		// include file
		$source = Kohana::find_file('views', 'media/'.$ext.'/'.$file, $ext );
		
		if( $source )
		{
			include $source;
		}

		echo '';
	}
	
	/**
	 * protected method for stripping extension off a string
	 *
	 * @param string $string	string to be processed
	 * @param string $ext		extension to strip off string
	 * @return string		 	returns string with extension stripped
	 */
	protected function strip_extension($string, $ext)
	{
		$ext_pos = 0 - strlen( '.'.$ext );
		$has_ext = ( substr($string,$ext_pos) == '.'.$ext ) ? TRUE : FALSE ;
		return ( $has_ext ) ? substr($string,0,$ext_pos) : $string;
	}
	
	/**
	 * protected method for stripping an array of extensions from a string
	 *
	 * @param string $string 	string to be processed
	 * @param array $exts		array of extensions to strip from string
	 * @return string			returns string with extensions stripped
	 */
	protected function strip_extensions( $string, $exts )
	{
		foreach( $exts as $ext ){
			$string = $this->strip_extension( $string, $ext );
		}
		return $string;
	}
	
}