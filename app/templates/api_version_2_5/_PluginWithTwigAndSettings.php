<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginDescription}}
 *
{{#if codeComments}}
 * --snip--
 * Craft plugins are very much like little applications in and of themselves. We’ve made it as simple as we can,
 * but the training wheels are off. A little prior knowledge is going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL, as well as some semi-
 * advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
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

class {{pluginHandle}}Plugin extends BasePlugin
{
    /**
{{#if codeComments}}
     * Called after the plugin class is instantiated; do any one-time initialization here such as hooks and events:
     *
     * craft()->on('entries.saveEntry', function(Event $event) {
     *    // ...
     * });
     *
     * or loading any third party Composer packages via:
     *
     * require_once __DIR__ . '/vendor/autoload.php';
     *
{{/if}}
     * @return mixed
     */
    public function init()
    {
    }

    /**
{{#if codeComments}}
     * Returns the user-facing name.
     *
{{/if}}
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('{{pluginName}}');
    }

    /**
{{#if codeComments}}
     * Plugins can have descriptions of themselves displayed on the Plugins page by adding a getDescription() method
     * on the primary plugin class:
     *
{{/if}}
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('{{pluginDescription}}');
    }

    /**
{{#if codeComments}}
     * Plugins can have links to their documentation on the Plugins page by adding a getDocumentationUrl() method on
     * the primary plugin class:
     *
{{/if}}
     * @return string
     */
    public function getDocumentationUrl()
    {
        return '{{pluginDocsUrl}}';
    }

    /**
{{#if codeComments}}
     * Plugins can now take part in Craft’s update notifications, and display release notes on the Updates page, by
     * providing a JSON feed that describes new releases, and adding a getReleaseFeedUrl() method on the primary
     * plugin class.
     *
{{/if}}
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return '{{pluginReleasesUrl}}';
    }

    /**
{{#if codeComments}}
     * Returns the version number.
     *
{{/if}}
     * @return string
     */
    public function getVersion()
    {
        return '{{pluginVersion}}';
    }

    /**
{{#if codeComments}}
     * As of Craft 2.5, Craft no longer takes the whole site down every time a plugin’s version number changes, in
     * case there are any new migrations that need to be run. Instead plugins must explicitly tell Craft that they
     * have new migrations by returning a new (higher) schema version number with a getSchemaVersion() method on
     * their primary plugin class:
     *
{{/if}}
     * @return string
     */
    public function getSchemaVersion()
    {
        return '{{pluginVersion}}';
    }

    /**
{{#if codeComments}}
     * Returns the developer’s name.
     *
{{/if}}
     * @return string
     */
    public function getDeveloper()
    {
        return '{{pluginAuthorName}}';
    }

    /**
{{#if codeComments}}
     * Returns the developer’s website URL.
     *
{{/if}}
     * @return string
     */
    public function getDeveloperUrl()
    {
        return '{{pluginAuthorUrl}}';
    }

    /**
{{#if codeComments}}
     * Returns whether the plugin should get its own tab in the CP header.
     *
{{/if}}
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
{{#if codeComments}}
     * Add any Twig extensions.
     *
{{/if}}
     * @return mixed
     */
    public function addTwigExtension()
    {
        Craft::import('plugins.{{pluginDirName}}.twigextensions.{{pluginHandle}}TwigExtension');

        return new {{pluginHandle}}TwigExtension();
    }

    /**
{{#if codeComments}}
     * Called right before your plugin’s row gets stored in the plugins database table, and tables have been created
     * for it based on its records.
{{/if}}
     */
    public function onBeforeInstall()
    {
    }

    /**
{{#if codeComments}}
     * Called right after your plugin’s row has been stored in the plugins database table, and tables have been
     * created for it based on its records.
{{/if}}
     */
    public function onAfterInstall()
    {
    }

    /**
{{#if codeComments}}
     * Called right before your plugin’s record-based tables have been deleted, and its row in the plugins table
     * has been deleted.
{{/if}}
     */
    public function onBeforeUninstall()
    {
    }

    /**
{{#if codeComments}}
     * Called right after your plugin’s record-based tables have been deleted, and its row in the plugins table
     * has been deleted.
{{/if}}
     */
    public function onAfterUninstall()
    {
    }

    /**
{{#if codeComments}}
     * Defines the attributes that model your plugin’s available settings.
     *
{{/if}}
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'someSetting' => array(AttributeType::String, 'label' => 'Some Setting', 'default' => ''),
        );
    }

    /**
{{#if codeComments}}
     * Returns the HTML that displays your plugin’s settings.
     *
{{/if}}
     * @return mixed
     */
    public function getSettingsHtml()
    {
       return craft()->templates->render('{{pluginDirName}}/{{pluginHandle}}_Settings', array(
           'settings' => $this->getSettings()
       ));
    }

    /**
{{#if codeComments}}
     * If you need to do any processing on your settings’ post data before they’re saved to the database, you can
     * do it with the prepSettings() method:
     *
     * @param mixed $settings  The Widget's settings
     *
{{/if}}
     * @return mixed
     */
    public function prepSettings($settings)
    {
        // Modify $settings here...

        return $settings;
    }
}