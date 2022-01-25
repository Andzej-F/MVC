<?php

class Paginator
{

    protected $conn;
    protected $limit;
    protected $page;
    protected $query;
    protected $total; //14

    public function __construct($conn, $query)
    {

        $this->conn = $conn; // PDO Object()

        $this->query = $query;

        $rs = $this->conn->query($this->query);
        $this->total = $rs->rowCount();
    }

    public function getData($limit, $page)
    {

        echo '<pre>';
        print_r($this);
        echo '</pre>';
        exit;

        $this->limit   = $limit;
        $this->page    = $page;

        if ($this->limit == 'all') {
            $query      = $this->query;
        } else {
            $query      = $this->query . " LIMIT " . (($this->page - 1) * $this->limit) . ", $this->limit";
        }
        $rs             = $this->conn->query($query);

        while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
            $results[]  = $row;
            echo '<pre>';
            var_dump($row);
            // print_r($results);
            echo '</pre>';
        }

        // $results = $rs->fetchAll(PDO::FETCH_ASSOC);

        $result         = new stdClass();
        $result->page   = $this->page;
        $result->limit  = $this->limit;
        $result->total  = $this->total;
        $result->data   = $results;

        echo '<pre>';
        print_r($result);
        echo '</pre>';

        return $result;
    }

    /**
     * Create pagination links
     * 
     * @param string $links number of links to display below and above the current page
     * @param string $list_class Styling class
     * 
     * @return string $html returns HTML code
     */
    public function createLinks($links, $list_class)
    {
        if ($this->limit == 'all') {
            return '';
        }

        $last       = ceil($this->total / $this->limit);

        $start      = (($this->page - $links) > 0) ? $this->page - $links : 1;
        $end        = (($this->page + $links) < $last) ? $this->page + $links : $last;

        $html       = '<ul class="' . $list_class . '">';

        $class      = ($this->page == 1) ? "disabled" : "";
        $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->limit . '&page=' . ($this->page - 1) . '">&laquo;</a></li>';

        if ($start > 1) {
            $html   .= '<li><a href="?limit=' . $this->limit . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class  = ($this->page == $i) ? "active" : "";
            $html   .= '<li class="' . $class . '"><a href="?limit=' . $this->limit . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li><a href="?limit=' . $this->limit . '&page=' . $last . '">' . $last . '</a></li>';
        }

        $class      = ($this->page == $last) ? "disabled" : "";
        $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->limit . '&page=' . ($this->page + 1) . '">&raquo;</a></li>';

        $html       .= '</ul>';

        return $html;
    }
}
