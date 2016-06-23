<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginHandle}}{{elementName[index]}} Model
 *
{{#if codeComments}}
 * --snip--
 * Models are containers for data. Just about every time information is passed between services, controllers, and
 * templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * https://craftcms.com/docs/plugins/working-with-elements
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

class {{pluginHandle}}{{elementName[index]}}Model extends BaseElementModel
{
    /**
{{#if codeComments}}
     * Defines this model's attributes.
     *
{{/if}}
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            'someField'     => array(AttributeType::String, 'default' => 'some value'),
        ));
    }

    /**
{{#if codeComments}}
     * Returns whether the current user can edit the element.
     *
{{/if}}
     * @return bool
     */
    public function isEditable()
    {
    }

    /**
{{#if codeComments}}
     * Returns the element's CP edit URL.
     *
{{/if}}
     * @return string|false
     */
    public function getCpEditUrl()
    {
    }
}