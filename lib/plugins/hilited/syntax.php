<?php
/**
 * Hilited Plugin: enables hilited text with syntax !!text!!
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Esther Brunner <esther [at] kaffeehaus [dot] ch>
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_hilited extends DokuWiki_Syntax_Plugin {
 
    /**
     * return some info
     */
    function getInfo(){
        return array(
            'author' => 'Esther Brunner',
            'email'  => 'esther@kaffeehaus.ch',
            'date'   => '2005-06-27',
            'name'   => 'Hilited Plugin',
            'desc'   => 'Enables highlighted text',
            'url'    => 'http://wiki.splitbrain.org/plugin:hilited',
        );
    }
 
    /**
     * What kind of syntax are we?
     */
    function getType(){
        return 'formatting';
    }
 
    /**
     * What modes are allowed within our mode?
     */
    function getAllowedTypes() {
        return array('substition','protected','disabled','formatting');
    }
 
    /**
     * Where to sort in?
     */
    function getSort(){
        return 95;
    }
 
    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
      $this->Lexer->addEntryPattern('\!\!(?=.*\!\!)',$mode,'plugin_hilited');
    }
 
    function postConnect() {
      $this->Lexer->addExitPattern('\!\!','plugin_hilited');
    }
 
    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        return array($match, $state);
    }            
 
    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        if($mode == 'xhtml'){
            if ($data[1] == DOKU_LEXER_ENTER){
                $renderer->doc .= '<span class="hilited">';
            } else if ($data[1] == DOKU_LEXER_UNMATCHED){
                $renderer->doc .= $renderer->_xmlEntities($data[0]);
            } else if ($data[1] == DOKU_LEXER_EXIT){
                $renderer->doc .= '</span>';
            }
            return true;
        }
        return false;
    }
     
}
 
//Setup VIM: ex: et ts=4 enc=utf-8 :
?>
