<?php
/**
 * Calendar class
 */
namespace Canjono\Calendar;

class Calendar
{
    /**
     * @var [] $currentMonth Info about month currently on display
     * @var int $noOfDays Number of days of current month
     * @var int $noOfDaysPrevious Number of days of previous month
     * @var [] $weekdayIndexes All weekdays indexes.
     *                         Used to find out how many days should be printed
     *                         from previous month, and to get all weekday names.
     * @var [] $imageLinks Name of each month's image file
     */
    private $currentMonth;
    private $noOfDays;
    private $noOfDaysPrevious;
    private $weekdayIndexes = [
        "Monday" => 0,
        "Tuesday" => 1,
        "Wednesday" => 2,
        "Thursday" => 3,
        "Friday" => 4,
        "Saturday" => 5,
        "Sunday" => 6
    ];
    public $imageLinks = [
        "January" => "january.jpg",
        "February" => "february.jpg",
        "March" => "march.jpg",
        "April" => "april.jpg",
        "May" => "may.jpg",
        "June" => "june.jpg",
        "July" => "july.jpg",
        "August" => "august.jpg",
        "September" => "september.jpg",
        "October" => "october.jpg",
        "November" => "november.jpg",
        "December" => "december.jpg"
    ];

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $date = getdate();
        $timestampFirst = mktime(0, 0, 0, $date["mon"], 1, $date["year"]);
        $timestampPrevious = strtotime("-1 day", $timestampFirst);

        $this->currentMonth = getdate($timestampFirst);
        $this->noOfDays = date("t", $timestampFirst);
        $this->noOfDaysPrevious = date("t", $timestampPrevious);
    }

    /**
     * Get link to month image
     *
     * @param string $month Month to get picture of
     * @return string Link to image, if it doesn't exist return null
     */
    public function getMonthImg($month)
    {
        if (array_key_exists($month, $this->imageLinks)) {
            return $this->imageLinks[$month];
        }
        return null;
    }

    /**
     * Switch to a new month
     *
     * @param int $timestamp Timestamp of new month
     * @return void
     */
    public function setNewMonth($timestamp)
    {
        $timestampPrevious = strtotime("-1 month", $timestamp);
        $this->currentMonth = getdate($timestamp);
        $this->noOfDays = date("t", $timestamp);
        $this->noOfDaysPrevious = date("t", $timestampPrevious);
    }

    /**
     * Get timestamp of previous month
     *
     * @param int $current Current timestamp of calendar
     * @return int Previous month timestamp
     */
    public function getPreviousMonth($current)
    {
        return strtotime("-1 month", $current);
    }

    /**
     * Get timestamp of next month
     *
     * @param int $current Current timetamp of calendar
     * @return int Next month timestamp
     */
    public function getNextMonth($current)
    {
        return strtotime("+1 month", $current);
    }

    /**
     * Get info about the current month
     *
     * @return [] info about current month like month name, timestamp etc.
     */
    public function getMonthInfo()
    {
        return $this->currentMonth;
    }

    /**
     * Get timestamp of first day of current month
     *
     * @return int Timestamp of first day of current month
     */
    public function getTimestamp()
    {
        return $this->currentMonth[0];
    }

    /**
     * Get name of current month
     *
     * @return string Name of current month
     */
    public function getMonthName()
    {
        return $this->currentMonth["month"];
    }

    /**
     * Get array with all days of current month in calendar
     *
     * @return [] Each day of the month as a number
     */
    public function getDaysAsArray()
    {
        $days = [];
        $startCurrent = $this->weekdayIndexes[$this->currentMonth["weekday"]];
        $startPrevious = $this->noOfDaysPrevious - ($startCurrent - 1);
        // Add days of previous month
        for ($i = $startPrevious; $i <= $this->noOfDaysPrevious; $i++) {
            $days[] = $i;
        }
        // Add days of current month
        for ($j = 1; $j <= $this->noOfDays; $j++) {
            $days[] = $j;
        }
        // Add days of next month
        for ($k = 1; count($days) % 7 !== 0; $k++) {
            $days[] = $k;
        }
        return $days;
    }

    /**
     * Get month as a table
     *
     * @return string Html table of current month
     */
    public function getMonthAsTable()
    {
        // Get all days to put in calendar
        $days = $this->getDaysAsArray();

        // Start table
        $html = "<table class='table'><thead><tr>";

        // Add weekday names to table head
        foreach (array_keys($this->weekdayIndexes) as $key) {
            $html .= "<th>{$key}</th>";
        }
        $html .= "</tr></thead><tbody>";

        // Add day numbers to table body
        for ($i = 0; $i < count($days); $i++) {
            // New row at start of week
            $html .= $i % 7 === 0 ? "<tr>" : "";

            if (($days[$i] > $i + 7) || ($days[$i] < $i - 7)) {
                // Add class 'outside' if number is part of previous or next month
                $html .= "<td class='outside'>";
            } elseif ($i % 7 === 6) {
                // Add class 'red' to Sundays
                $html .= "<td class='red'>";
            } else {
                $html .= "<td>";
            }
            $html .= "{$days[$i]}</td>";
            // Close row at end of week
            $html .= $i % 7 === 6 ? "</tr>" : "";
        }
        $html .= "</tbody></table>";
        return $html;
    }
}
