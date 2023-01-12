<?php
/**
 * Math Plugin: Render Tex Math expression into images using mimetex
 *              http://www.forkosh.com/mimetex.html
 *              Can be easely adapted to render using latexrenderer, or itex2mml or plain2mml
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Stephane Chamberland <stephane.chamberland@ec.gc.ca>
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_math extends DokuWiki_Syntax_Plugin {
 
    /**
     * return some info
     */
    function getInfo(){
        return array(
            'author' => 'Stephane Chamberland',
            'email'  => 'stephane.chamberland@ec.gc.ca',
            'date'   => '2005-07-04',
            'name'   => 'Math Plugin',
            'desc'   => 'Render (la)Tex Math expretions as images (<math>x=frac{y^2}{2}</math>)',
            'url'    => 'http://wiki.splitbrain.org/plugin:math',
        );
    }
 
    /**
     * What kind of syntax are we?
     */
    function getType(){
        //return 'substition';
        return 'formatting';
    }
   
   /**
    * Paragraph Type
    *
    * Defines how this syntax is handled regarding paragraphs. This is important
    * for correct XHTML nesting. Should return one of the following:
    *
    * 'normal' - The plugin can be used inside paragraphs
    * 'block'  - Open paragraphs need to be closed before plugin output
    * 'stack'  - Special case. Plugin wraps other paragraphs.
    *
    * @see Doku_Handler_Block
    */
    function getPType(){
        return 'normal';
    }
 
    /**
     * Where to sort in?
     */ 
    function getSort(){
        return 155;
    }
 
 
    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addEntryPattern('<math(?=.*\x3C/math\x3E)',$mode,'plugin_math');
    }
    function postConnect() {
        $this->Lexer->addExitPattern('</math>','plugin_math');
    }
 
 
    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        switch ( $state ) {
            case DOKU_LEXER_UNMATCHED:
                $matches = preg_split('/>/u',$match,2);
                $matches[0] = trim($matches[0]);
                if ( trim($matches[0]) == '' ) {
                    $matches[0] = NULL;
                }
                // $matches[0] contains name of programming language if available
	        return array($matches[1],$matches[0]);
            break;
        }
        return TRUE;
    }
 
    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        if($mode == 'xhtml' && strlen($data[0]) > 1) {
	    if (is_null($data[1]) || $data[1] == 'tex' ) {
	        $renderer->doc .= $this->_mimetex($data[0]);
            //} else if ($data[1] == 'plain') {
            //} else if ($data[1] == 'itex') {
            //} else if ($data[1] == 'latex') {
            } else {
		//I guess it would be better to escape the character in this case
                $renderer->doc .= $data[0];
            }
            return true;
        }
        return false;
    }
 
    /**
     * Render math expression to gif using mimetex
     * http://www.forkosh.com/mimetex.html
     */
    function _mimetex($mymathexpr) {
	//return '<img src="/cgi-bin/mimetex.cgi?'.
     return '<img src="/cgi-bin/mimetex.cgi?'.
		$mymathexpr.'" alt="'.$mymathexpr.
		'" class="math"/>';
    }
 
}
?>
