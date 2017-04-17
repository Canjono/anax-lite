<?php
namespace Canjono\Functions;

/**
 * Helper functions class
 *
 * @param array $th All the table headers
 * @param array $td All the table data as objects
 * @return string HTML table
 */
class Functions
{
    /**
     * Get an HTML table
     *
     * @param array $headers All data to put in header cells
     * @param array $data All data to put in standard cells
     * @return string HTML table
     */
    public function getHTMLTable($headers, $data)
    {
        $html = "<table class='table'><thead><tr>";

        // Add all header cells
        foreach ($headers as $val) {
            $html .= "<td>{$val}</th>";
        }

        // Add all standard cells
        $html .= "</tr></thead><tbody>";
        $dataLength = count($data);
        for ($i = 0; $i < $dataLength; $i++) {
            $html .= "<tr>";
            foreach ($data[$i] as $val) {
                $html .= "<td>{$val}</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";
        return $html;
    }


    /**
     * Make an html table of registrated users
     *
     * @param array $allUsers Users to put in the table
     * @return string HTML table
     */
    public function getUsersTables($allUsers)
    {
        $users = [];
        foreach ($allUsers as $user) {
            $updateRoute = $this->url->create("admin/update?user={$user->user}");
            $deleteRoute = $this->url->create("admin/delete?user={$user->user}");
            $updateLink = "<a href='{$updateRoute}'>Uppdatera</a>";
            $deleteLink = "<a href='{$deleteRoute}'>Ta bort</a>";
            $alteredUser = [
                $user->user,
                $user->fname,
                $user->lname,
                $user->email,
                $user->permission,
                $updateLink,
                $deleteLink
            ];
            $users[] = $alteredUser;
        }
        // Create an admin and users HTML table
        $headers = [
            "Användarnamn" . $this->orderby("user"),
            "Förnamn" . $this->orderby("fname"),
            "Efternamn" . $this->orderby("lname"),
            "Email" . $this->orderby("email"),
            "Nivå" . $this->orderby("permission"),
            "Uppdatera",
            "Ta bort"
            ];
        $usersTable = $this->getHTMLTable($headers, $users);
        return $usersTable;
    }


    /**
    * Use current querystring as base, extract it to an array, merge it
    * with incoming $options and recreate the querystring using the resulting
    * array.
    *
    * @param array  $options to merge into exitins querystring
    * @param string $prepend to the resulting query string
    *
    * @return string as an url with the updated query string.
    */
    public function mergeQueryString($options, $prepend = "?")
    {
        // Parse querystring into array
        $query = [];
        parse_str($_SERVER["QUERY_STRING"], $query);

        // Merge query string with new options
        $query = array_merge($query, $options);

        // Build and return the modified querystring as url
        return $prepend . http_build_query($query);
    }


    /**
    * Function to create links for sorting and keeping the original querystring.
    *
    * @param string $column the name of the database column to sort by
    * @param string $route  prepend this to the anchor href
    *
    * @return string with links to order by column.
    */
    public function orderby($column, $route = "?")
    {
        $asc = $this->mergeQueryString(["orderby" => $column, "order" => "asc"], $route);
        $desc = $this->mergeQueryString(["orderby" => $column, "order" => "desc"], $route);
        
        return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>
<a href="$desc">&uarr;</a>
</span>
EOD;
    }


    /**
     * Inject Url object to create links
     *
     * @param object $url The Url object
     * @return $this for chaining
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Inject User object to get data about the logged in user
     *
     * @param object $user User object
     * @return $this for chaining
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
