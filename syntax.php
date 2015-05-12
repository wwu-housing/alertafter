<?php
/**
 * alertafter Plugin: Display the timestamp of the last modification
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Dennis Ploeger <develop@dieploegers.de>
 */

if (!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_alertafter extends DokuWiki_Syntax_Plugin {

    /**
     * What kind of syntax are we?
     */
    function getType() {
        return 'substition';
    }

    /**
     * What about paragraphs?
     */
    function getPType() {
        return 'normal';
    }

    /**
     * Where to sort in?
     */
    function getSort() {
        return 155;
    }


    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('~~ALERTAFTER[^~]*~~', $mode, 'plugin_alertafter');
    }


    /**
     * Handle the match
     */

    function handle($match, $state, $pos, &$handler) {
        global $ID, $INFO;
        $expireDate = 0;

        $modified = pageinfo()['meta']['date']['modified'];

        if (preg_match("/:/", $match)) {
            preg_match("/:([^~]*)/", $match, $matches);

            // calculate date to show alert on
            $expireDate = strtotime($matches[1], $modified);

            $offset = $matches[1];
        }

        // default - if invalid or no date specified
        if ($expireDate == 0) {
            $expireDate = strtotime("+1 second", $modified);
        }

        return array($expireDate);
    }

    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        global $INFO, $conf;

        if ($mode == 'xhtml') {
            $expireDate = $data[0];
            if (time() > $expireDate) {
                $renderer->doc .= "<div class=\"alert alert-danger\"><p class=\"lead\">This page may be out of date!</p></div>";
            }
            return true;
        }
        return false;
    }

}

?>
