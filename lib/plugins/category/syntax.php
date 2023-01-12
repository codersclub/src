<?php
/**
 * Category Plugin: displays list of keywords with links to categories this page
 * belongs to. The links are marked as tags for Technorati and other services
 * using tagging.
 *
 * Usage: ??category tags separated through spaces??
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
class syntax_plugin_category extends DokuWiki_Syntax_Plugin {
 
    /**
     * return some info
     */
    function getInfo(){
        return array(
            'author' => 'Esther Brunner',
            'email'  => 'esther@kaffeehaus.ch',
            'date'   => '2005-07-12',
            'name'   => 'Category Plugin',
            'desc'   => 'Displays a list of keywords with links to categories this page belongs to. '.
                        'The links are marked as tags for Technorati and other services using tagging.',
            'url'    => 'http://wiki.splitbrain.org/plugin:category',
        );
    }
 
    /**
     * What kind of syntax are we?
     */
    function getType(){
        return 'substition';
    }
 
    /**
     * Where to sort in?
     */
    function getSort(){
        return 305;
    }
    
    /**
     * Paragraph Type
     */
    function getPType(){
        return 'block';
    }
 
    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern("\?\?.+?\?\?",$mode,'plugin_category');
    }
  
    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        $match = substr($match,2,-2);  // strip markup
        $match = explode(' ',$match);  // split tags
        return $match;
    }            
 
    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        global $ID;
        global $conf;
    
        if($mode == 'xhtml'){
                        
            $renderer->doc .= '<div class="category">';
            $c = count($data);
            for ($i = 0; $i < $c; $i++) {
                $tag = $data[$i];
                $title = str_replace('_', ' ' ,noNS($tag));
                resolve_pageid(getNS($ID),$tag,$exists); // resolve shortcuts
                if ($exists){
                    $class = 'wikilink1';
                    if ($conf['useheading']) {
                        $oldtitle = $title;
                        $title = trim(p_get_first_heading($tag));
                        if (!$title) $title = $oldtitle;
                    }
                } else {
                    $class = 'wikilink2';
                }
                $renderer->doc .= '<a href="'.wl($tag).'" class="'.$class.'" rel="tag" '.
                                  'onclick="return svchk()" onkeypress="return svchk()">'.$title.'</a>';
                if ($i !== ($c - 1)) $renderer->doc .= ', ';
            }
            $renderer->doc .= '</div>';
            return true;
        }
        return false;
    }
     
}
 
//Setup VIM: ex: et ts=4 enc=utf-8 :
?>