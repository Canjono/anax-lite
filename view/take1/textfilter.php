<?php
$nl2br = <<<EOD
Första raden.
Andra raden.

Fjärde raden.
EOD;

$bbcode = <<<EOD
Fetstil: [b]Fet text[/b]
Understruken: [u]Understruken text[/u]
Kursiv: [i]Kursiv text[/i]
Länk: [url=http://dbwebb.se]Länk till dbwebb[/url]
EOD;

$markdown = <<<EOD
Länk: [En länk till dbwebb.se](http://dbwebb.se "Dbwebb.se")

Lista:

* Första
* Andra
* Tredje
EOD;
?>

<div class="container textfilter" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Test av Textfilter-klassen</h1>
            </div>
        </div>
    </div>

    <div class="row format-section">
        <div class="col">
            <h2>Nl2br</h2>

            <div class="format-part">
                <h3>Originalformat</h3>
                <pre><p><?= $nl2br ?></p></pre>
            </div>
            <div class="format-part">
                <h3>Utan formattering</h3>
                <p><?= $nl2br ?></p>
            </div>
            <div class="format-part">
                <h3>Efter formattering ("nl2br")</h3>
                <p><?= $app->textfilter->doFilter($nl2br, "nl2br") ?></p>
            </div>
        </div>
    </div>
    <div class="row format-section">
        <div class="col">
            <h2>Bbcode</h2>

            <div class="format-part">
                <h3>Originalformat</h3>
                <pre><p><?= $bbcode ?></p></pre>
            </div>
            <div class="format-part">
                <h3>Utan formattering</h3>
                <p><?= $bbcode ?></p>
            </div>
            <div class="format-part">
                <h3>Efter formattering ("nl2br,bbcode")</h3>
                <p><?= $app->textfilter->doFilter($bbcode, "nl2br,bbcode") ?></p>
            </div>
        </div>
    </div>
    <div class="row format-section">
        <div class="col">
            <h2>Markdown</h2>

            <div class="format-part">
                <h3>Originalformat</h3>
                <pre><p><?= $markdown ?></p></pre>
            </div>
            <div class="format-part">
                <h3>Utan formattering</h3>
                <p><?= $markdown ?></p>
            </div>
            <div class="format-part">
                <h3>Efter formattering ("markdown")</h3>
                <p><?= $app->textfilter->doFilter($markdown, "markdown") ?></p>
            </div>
        </div>
    </div>
</div>
