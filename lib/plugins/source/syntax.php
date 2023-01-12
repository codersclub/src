<?php
/**
 * Source Plugin: includes a source file using the geshi highlighter
 *
 * Syntax:     <source filename lang|title>
 *   filename  (required) can be a local path/file name or a remote file uri
 *             to use remote file uri, allow_url_fopen=On must be set in the server's php.ini
 *             filenames with spaces must be surrounded by matched pairs of quotes (" or ')
 *   lang      (optional) programming language name, is passed to geshi for code highlighting
 *             if not provided, the plugin will attempt to derive a value from the file name
 *             (refer $extensions in render() method)
 *   title     (optional) all text after '|' will be rendered above the main code text with a
 *             different style. If no title is present, it will be set to "file: filename"
 *
 *  *** WARNING ***
 *
 *  Unless configured correctly this plugin can be a huge security risk.
 *  Please review/consider
 *    - users who have access to the wiki
 *    - php.ini setting, allow_url_fopen
 *    - php.ini setting, base_dir
 *    - $location, $allow & $deny settings below.
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Christopher Smith <chris@jalakai.co.uk>  
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

global $extensions, $location, $allow, $deny;

//------------------------[ Security settings ] ---------------------------------------------
// $location is prepended to all file names, restricting the filespace exposed to the plugin
$location = '';

// if $allow array contains any elements, ONLY files with the extensions listed will be allowed
$allow = array();
  
// if the $allow array is empty, any file with an extension listed in $deny array will be denied 
$deny = array('php');
          
//------------------------[ Other settings ] ---------------------------------------------
// list of common file extensions and their language equivalent
// (required only where the extension and the language are not the same)
$extensions = array(
    'htm' => 'html4strict',
    'html' => 'html4strict',
    'js' => 'javascript'
  );
  
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_source extends DokuWiki_Syntax_Plugin {

    /**
     * return some info
     */
    function getInfo(){
      return array(
        'author' => 'Christopher Smith',
        'email'  => 'chris@jalakai.co.uk',
        'date'   => '2005-08-23',
        'name'   => 'Source Plugin',
        'desc'   => 'Include a remote source file
                     Syntax: <source filename language|title>',
        'url'    => 'http://wiki.splitbrain.org/plugin:source',
      );
    }

    function getType(){ return 'substition'; }
    function getPType(){ return 'block'; }
    function getSort(){ return 330; }

    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {       
      $this->Lexer->addSpecialPattern('<source.*?>',$mode,substr(get_class($this), 7));
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
      $match = trim(substr($match,7,-1));                    //strip <source from start and > from end
      list($attr, $title) = preg_split('/\|/u', $match, 2);  //split out title
//    list($file, $lang) = preg_split('/\s+/',$attr, 3);     //split out file name and language
      
// alternate method to get $file & $lang allowing for filenames with spaces
      $attr = trim($attr);
      $pattern = ($attr{0} == '"' || $attr{0} == "'") ? $attr{0} : '\s';
      list($file, $lang) = preg_split("/$pattern/u", $attr, 3, PREG_SPLIT_NO_EMPTY);

      return array(trim($file), (isset($lang)?trim($lang):''), (isset($title)?trim($title):''));
    }

    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
      global $extensions, $location, $allow, $deny;
    
      if($mode == 'xhtml'){
      
        list($file, $lang, $title) = $data;
        $ext = substr(strrchr($file, '.'),1);
      
        $ok = false;
        if (count($allow)) {
          if (in_array($ext, $allow)) $ok = true;
        } else {
          if (!in_array($ext, $deny)) $ok = true;
        }      
      
        // prevent filenames which attempt to move up directory tree by using ".."        
        if ($ok && $location && preg_match('/(?:^|\/)\.\.(?:\/|$)/', $file)) $ok = false;
        
        if ($ok && ($source = @file_get_contents($location.$file))) {
        
          if (!$lang) { $lang = isset($extensions[$ext]) ? $extensions[$ext] : $ext; }
          $title = ($title) ? "<span>".$renderer->_xmlEntities($title)."</span>" 
                             : "file: <span>".$renderer->_xmlEntities($file)."</span>";
          
          $renderer->doc .= "<div class='source'><p>$title</p>";
          $renderer->code($source, $lang);
          $renderer->doc .= "</div>";
          return true;
        } else {
          $renderer->doc .= "<div class='source'><p><span>Unable to display file &quot;".$renderer->_xmlEntities($file)."&quot;: It may not exist, or permission may be denied.</span></p></div>";
        }
      }
      return false;
    }
}

//Setup VIM: ex: et ts=4 enc=utf-8 :
