<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginName}} Twig Extension
 *
{{#if codeComments}}
 * --snip--
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators, global variables, and
 * functions. You can even extend the parser itself with node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 * --snip--
 *
{{/if}}
 * @author    {{pluginAuthorName}}
 * @copyright {{copyrightNotice}}
 * @link      {{pluginAuthorUrl}}
 * @package   {{pluginHandle}}
 * @since     {{pluginVersion}}
 */

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class {{pluginHandle}}TwigExtension extends \Twig_Extension
{
    /**
{{#if codeComments}}
     * Returns the name of the extension.
     *
{{/if}}
     * @return string The extension name
     */
    public function getName()
    {
        return '{{pluginHandle}}';
    }

    /**
{{#if codeComments}}
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
{{/if}}
     * @return array
     */
    public function getFilters()
    {
        return array(
            'someFilter' => new \Twig_Filter_Method($this, 'someInternalFunction'),
        );
    }

    /**
{{#if codeComments}}
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
 {{/if}}
    * @return array
     */
    public function getFunctions()
    {
        return array(
            'someFunction' => new \Twig_Function_Method($this, 'someInternalFunction'),
        );
    }

    /**
{{#if codeComments}}
     * Our function called via Twig; it can do anything you want
     *
 {{/if}}
     * @return string
     */
    public function someInternalFunction($text = null)
    {
        $result = $text . " in the way";

        return $result;
    }
}