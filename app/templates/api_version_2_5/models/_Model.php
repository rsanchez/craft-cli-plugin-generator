<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginHandle}}{{modelName[index]}} Model
 *
{{#if codeComments}}
 * --snip--
 * Models are containers for data. Just about every time information is passed between services, controllers, and
 * templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
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

class {{pluginHandle}}{{modelName[index]}}Model extends BaseModel
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

}