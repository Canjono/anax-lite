<?php

namespace Canjono\Textfilter;

/**
 * Textfilter class
 */
class Textfilter
{
    /**
     * Do text formatting on text
     *
     * @param $text string The text to format
     * @param $filter string Filters to use when formatting
     * @return string Filtered text
     */
    public function doFilter($text, $filters = null)
    {
        if ($filters) {
            $callbacks = [
                "bbcode" => "bbcode2html",
                "nl2br" => "nl2br",
                "markdown" => "markdown",
                "link" => "makeClickable"
            ];

            $filters = strtolower($filters);
            $filtersArr = preg_replace('/\s/', '', explode(",", $filters));

            foreach ($filtersArr as $filter) {
                if (!isset($callbacks[$filter])) {
                    throw new Exception("The filter '$filters' is not a valid filter string due to '$filter'.");
                }
                $text = call_user_func(array($this, $callbacks[$filter]), $text);
            }
        }

        return $text;
    }


    /**
    * Helper, BBCode formatting converting to HTML.
    *
    * @param string text The text to be converted.
    * @return string the formatted text.
    */
    public function bbcode2html($text)
    {
        $search = array(
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
            );
        $replace = array(
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
            );
        return preg_replace($search, $replace, $text);
    }

    /**
    * Make clickable links from URLs in text.
    *
    * @param string $text the text that should be formatted.
    * @return string with formatted anchors.
    */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            create_function(
                '$matches',
                'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
            ),
            $text
        );
    }

    /**
    * Helper, Markdown formatting converting to HTML.
    *
    * @param string text The text to be converted.
    *
    * @return string the formatted text.
    */
    public function markdown($text)
    {
        // Make an instance for validation
        $markdownObj = new \Michelf\Markdown();
        return $markdownObj->defaultTransform($text);
    }


    /**
     * Insert HTML line breaks before all newlines in a string
     *
     * @param $text string Text to format
     * @return string Formatted text
     */
    public function nl2br($text)
    {
        return nl2br($text);
    }


    /**
    * Escape string with htmlentities
    *
    * @param $text string Text to escape
    * @return string Escaped string
    */
    public function esc($text)
    {
        return htmlentities($text);
    }


    /**
     * Strip tags from string
     *
     * @param $text string Text to strip
     * @return string Text without tags
     */
    public function strip($text)
    {
        return strip_tags($text);
    }


    /**
     * Create a slug of a string, to used as url
     *
     * @param $text Text to slugify
     * @return string slugified text
     */
    public function slugify($text)
    {
        $text = mb_strtolower(trim($text));
        $text = str_replace(array('å','ä','ö'), array('a','a','o'), $text);
        $text = preg_replace('/[^a-z0-9-]/', '-', $text);
        $text = trim(preg_replace('/-+/', '-', $text), '-');
        return $text;
    }
}
