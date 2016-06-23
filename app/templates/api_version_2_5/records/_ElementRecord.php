<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginHandle}}{{elementName[index]}} Record
 *
{{#if codeComments}}
 * --snip--
 * Active record models (or “records”) are like models, except with a database-facing layer built on top. On top of
 * all the things that models can do, records can:
 *
 * - Define database table schemas
 * - Represent rows in the database
 * - Find, alter, and delete rows
 *
 * Note: Records’ ability to modify the database means that they should never be used to transport data throughout
 * the system. Their instances should be contained to services only, so that services remain the one and only place
 * where system state changes ever occur.
 *
 * When a plugin is installed, Craft will look for any records provided by the plugin, and automatically create the
 * database tables for them.
 *
 * https://craftcms.com/docs/plugins/records
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

class {{pluginHandle}}{{elementName[index]}}Record extends BaseRecord
{
    /**
{{#if codeComments}}
     * Returns the name of the database table the model is associated with (sans table prefix). By convention,
     * tables created by plugins should be prefixed with the plugin name and an underscore.
     *
{{/if}}
     * @return string
     */
    public function getTableName()
    {
        return '{{pluginDirName}}{{elementName[index]}}';
    }

    /**
{{#if codeComments}}
     * Returns an array of attributes which map back to columns in the database table.
     *
{{/if}}
     * @access protected
     * @return array
     */
   protected function defineAttributes()
    {
        return array(
            'someField'     => array(AttributeType::String, 'default' => ''),
        );
    }

    /**
{{#if codeComments}}
     * If your record should have any relationships with other tables, you can specify them with the
     * defineRelations() function
     *
{{/if}}
     * @return array
     */
    public function defineRelations()
    {
        return array(
        );
    }
}