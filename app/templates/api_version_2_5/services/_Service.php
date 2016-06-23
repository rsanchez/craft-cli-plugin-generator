<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginHandle}}{{serviceName[index]}} Service
 *
{{#if codeComments}}
 * --snip--
 * All of your plugin’s business logic should go in services, including saving data, retrieving data, etc. They
 * provide APIs that your controllers, template variables, and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
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

class {{pluginHandle}}{{serviceName[index]}}Service extends BaseApplicationComponent
{
    /**
{{#if codeComments}}
     * This function can literally be anything you want, and you can have as many service functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     craft()->{{pluginCamelHandle}}{{serviceName[index] ? "_" + serviceName[index][1].toLowerCase() + serviceName[index].slice(2) : ""}}->exampleService()
{{/if}}
     */
    public function exampleService()
    {
    }

}