<?php
/**
 * {{pluginName}} plugin for Craft CMS
 *
 * {{pluginHandle}}{{elementName[index]}} ElementType
 *
{{#if codeComments}}
 * --snip--
 * Element Types are the classes used to identify each of these types of elements in Craft. There’s a
 * “UserElementType”, there’s an “AssetElementType”, and so on. If you’ve ever developed a custom Field Type class
 * before, this should sound familiar. The relationship between an element and an Element Type is the same as that
 * between a field and a Field Type.
 *
 * http://pixelandtonic.com/blog/craft-element-types
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

class {{pluginHandle}}{{elementName[index]}}ElementType extends BaseElementType
{
    /**
{{#if codeComments}}
     * Returns this element type's name.
     *
{{/if}}
     * @return mixed
     */
    public function getName()
    {
        return Craft::t('{{pluginHandle}}{{elementName[index]}}');
    }

    /**
{{#if codeComments}}
     * Returns whether this element type has content.
     *
{{/if}}
     * @return bool
     */
    public function hasContent()
    {
        return true;
    }

    /**
{{#if codeComments}}
     * Returns whether this element type has titles.
     *
{{/if}}
     * @return bool
     */
    public function hasTitles()
    {
        return true;
    }

    /**
{{#if codeComments}}
     * Returns whether this element type can have statuses.
     *
{{/if}}
     * @return bool
     */
    public function hasStatuses()
    {
        return true;
    }

    /**
{{#if codeComments}}
     * Returns whether this element type is localized.
     *
{{/if}}
     * @return bool
     */
    public function isLocalized()
    {
        return false;
    }

    /**
{{#if codeComments}}
     * Returns this element type's sources.
     *
{{/if}}
     * @param string|null $context
     * @return array|false
     */
    public function getSources($context = null)
    {
    }

    /**
     * @inheritDoc IElementType::getAvailableActions()
     *
     * @param string|null $source
     *
     * @return array|null
     */
    public function getAvailableActions($source = null)
    {
    }

    /**
{{#if codeComments}}
     * Returns the attributes that can be shown/sorted by in table views.
     *
{{/if}}
     * @param string|null $source
     * @return array
     */
    public function defineTableAttributes($source = null)
    {
    }

    /**
{{#if codeComments}}
     * Returns the table view HTML for a given attribute.
     *
{{/if}}
     * @param BaseElementModel $element
     * @param string $attribute
     * @return string
     */
    public function getTableAttributeHtml(BaseElementModel $element, $attribute)
    {
    }

    /**
{{#if codeComments}}
     * Defines any custom element criteria attributes for this element type.
     *
{{/if}}
     * @return array
     */
    public function defineCriteriaAttributes()
    {
    }

    /**
{{#if codeComments}}
     * Modifies an element query targeting elements of this type.
     *
{{/if}}
     * @param DbCommand $query
     * @param ElementCriteriaModel $criteria
     * @return mixed
     */
    public function modifyElementsQuery(DbCommand $query, ElementCriteriaModel $criteria)
    {
   }

    /**
{{#if codeComments}}
     * Populates an element model based on a query result.
     *
{{/if}}
     * @param array $row
     * @return array
     */
    public function populateElementModel($row)
    {
    }

    /**
{{#if codeComments}}
     * Returns the HTML for an editor HUD for the given element.
     *
{{/if}}
     * @param BaseElementModel $element
     * @return string
     */
    public function getEditorHtml(BaseElementModel $element)
    {
    }
}