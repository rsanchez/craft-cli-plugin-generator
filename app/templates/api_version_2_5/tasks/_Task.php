<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginHandle}}{{taskName[index]}} Task
 *
{{#if codeComments}}
 * --snip--
 * Tasks let you run background processing for things that take a long time, dividing them up into steps.  For
 * example, Asset Transforms are regenerated using Tasks.
 *
 * Keep in mind that tasks only get timeslices to run when Craft is handling requests on your website.  If you
 * need a task to be run on a regular basis, write a Controller that triggers it, and set up a cron job to
 * trigger the controller.
 *
 * https://craftcms.com/classreference/services/TasksService
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

class {{pluginHandle}}{{taskName[index]}}Task extends BaseTask
{
    /**
{{#if codeComments}}
     * Defines the settings.
     *
{{/if}}
     * @access protected
     * @return array
     */

    protected function defineSettings()
    {
        return array(
            'someSetting' => AttributeType::String,
        );
    }

    /**
{{#if codeComments}}
     * Returns the default description for this task.
     *
{{/if}}
     * @return string
     */
    public function getDescription()
    {
        return '{{pluginHandle}}{{taskName[index]}} Tasks';
    }

    /**
{{#if codeComments}}
     * Gets the total number of steps for this task.
     *
{{/if}}
     * @return int
     */
    public function getTotalSteps()
    {
        return 1;
    }

    /**
{{#if codeComments}}
     * Runs a task step.
     *
{{/if}}
     * @param int $step
     * @return bool
     */
    public function runStep($step)
    {
        return true;
    }
}
