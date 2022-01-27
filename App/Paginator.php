<?php

namespace App;

class Paginator extends \Core\Model
{
    /**
     * Create pagination links
     *
     * @param string $limit Number of rows to display
     * @param string $links_nbr Number of links to display before and after the current page
     * @param string $page Number of links to display before and after the current page
     *
     * @return string $html returns HTML code
     */
    public static function createLinks($limit, $links, $page, $total)
    {
        $page  = (isset($_GET['page'])) ? $_GET['page'] : 1;

        if ($limit == 'all') {
            return '';
        }

        $last = ceil(intval($total) / $limit);
        $start = (($page - $links) > 0) ? $page - $links : 1;
        $end = (($page + $links) < $last) ? $page + $links : $last;

        $html = '<ul class="pagination justify-content-center pagination pagination-sm">';

        $class      = ($page == 1) ? " disabled" : "";
        $html .= '<li class="class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $limit . '&page=' . ($page - 1) . '">&laquo;</a></li>';

        if ($start > 1) {
            $html .= '<li><a class="page-link" href="?limit=' . $limit . '&page=1">1</a></li>';
            $html .= '<li class=" page-item disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ($page == $i) ? "active" : "";
            $html .= '<li class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $limit . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="class="page-item disabled"><span>...</span></li>';
            $html .= '<li><a class="page-link" href="?limit=' . $limit . '&page=' . $last . '">' . $last . '</a></li>';
        }

        $class = ($page == $last) ? "disabled" : "";
        $html .= '<li class=" page-item ' . $class . '"><a class="page-link" href="?limit=' . $limit . '&page=' . ($page + 1) . '">&raquo;</a></li>';

        $html .= '</ul>';

        return $html;
    }

    /**
     * Display the number of rows int the authors table
     * 
     * @return int Return list of authors
     */
    public static function getTotalRows($table_name)
    {
        // $sql = 'SELECT * FROM `';
        $sql = "SELECT * FROM `$table_name` WHERE 1";

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->rowCount();

        return $result;
    }
}
