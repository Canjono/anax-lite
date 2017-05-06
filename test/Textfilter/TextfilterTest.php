<?php

namespace Canjono\Textfilter;

/**
 * Test cases for class Guess.
 */
class TextfilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected properties due various ways of constructing
     * it.
     */
    public function testCreateObject()
    {
        $textfilter = new Textfilter();
        $this->assertInstanceOf("\Canjono\Textfilter\Textfilter", $textfilter);
    }


    /**
     * Test case for formatting a text
     */
    public function testDoFilter()
    {
        $textfilter = new Textfilter();
        $text = "[b]Testing[/b]\n";
        $formatted = "<strong>Testing</strong><br />\n";
        $filters = "bbcode,nl2br";
        $result = $textfilter->doFilter($text, $filters);
        $this->assertEquals($result, $formatted);
    }


    /**
     * Test case for bbcode formatting
     */
    public function testBbcode2html()
    {
        $textfilter = new Textfilter();
        $bbcode = "[b]bold[/b]";
        $html = "<strong>bold</strong>";
        $formatted = $textfilter->bbcode2html($bbcode);
        $this->assertEquals($formatted, $html);
    }


    /**
     * Test case for making clickable links from URLs in text
     */
    public function testMakeClickable()
    {
        $textfilter = new Textfilter();
        $url = "http://testing.com";
        $link = "<a href='http://testing.com'>http://testing.com</a>";
        $result = $textfilter->makeClickable($url);
        $this->assertEquals($result, $link);
    }


    /**
     * Test case for formatting string from Markdown to HTML
     */
    public function testMarkdown()
    {
        $textfilter = new Textfilter();
        $markdown = "## Testing";
        $html = "<h2>Testing</h2>\n";
        $result = $textfilter->markdown($markdown);
        $this->assertEquals($result, $html);
    }


    /**
     * Test case for inserting HTML line breaks before newlines in a string
     */
    public function testNl2br()
    {
        $textfilter = new Textfilter();
        $original = "Testing\n Newline";
        $html = "Testing<br />\n Newline";
        $result = $textfilter->nl2br($original);
        $this->assertEquals($result, $html);
    }


    /**
     * Test case for escaping string with htmlentities
     */
    public function testEsc()
    {
        $textfilter = new Textfilter();
        $original = "A 'quote' is <b>bold</b>";
        $escaped = "A 'quote' is &lt;b&gt;bold&lt;/b&gt;";
        $result = $textfilter->esc($original);
        $this->assertEquals($result, $escaped);
    }


    /**
     * Test case for stripping tags from string
     */
    public function testStrip()
    {
        $textfilter = new Textfilter();
        $original = "<p>Test paragraph.</p><!-- Comment --> <a href='#fragment'>Other text</a>";
        $stripped = "Test paragraph. Other text";
        $result = $textfilter->strip($original);
        $this->assertEquals($result, $stripped);
    }


    /**
     * Test case for creating a slug of a string
     */
    public function testSlugify()
    {
        $textfilter = new Textfilter();
        $original = "TESTING slögify";
        $slugified = "testing-slogify";
        $result = $textfilter->slugify($original);
        $this->assertEquals($result, $slugified);
    }


    /**
     * Test case for exception being an Exception in doFilter method
     */
    public function testException()
    {
        $textfilter = new Textfilter();
        $text = "[b]Testing[/b]\n";
        $filters = "wrongFilter";
        $this->expectException(Exception::class);
        $textfilter->doFilter($text, $filters);
    }
}
