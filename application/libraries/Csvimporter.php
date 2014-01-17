<?php
/**
 * Created by PhpStorm.
 * User: DAUSSY
 * Date: 17/01/14
 * Time: 15:45
 */

class CsvImporter
{
    private $fp;
    private $parse_header;
    private $header;
    private $delimiter;
    private $length;

    //$file_name, $parse_header=false, $delimiter="\t", $length=8000----------------
    function __construct($param)
    {

        $this->fp = fopen($param['file_name'], "r");
        $this->parse_header = $param['parse_header'];
        $this->delimiter = $param['delimiter'];
        $this->length = $param['length'];
        $this->lines = "";

        if ($this->parse_header)
        {
            $this->header = fgetcsv($this->fp, $this->length, $this->delimiter);
        }

    }
    //--------------------------------------------------------------------
    function __destruct()
    {
        if ($this->fp)
        {
            fclose($this->fp);
        }
    }
    //--------------------------------------------------------------------
    function get($max_lines=0,$name_simulation)
    {
        //if $max_lines is set to 0, then get all the data

        $data = array();

        if ($max_lines > 0)
            $line_count = 0;
        else
            $line_count = -1; // so loop limit is ignored

        while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE)
        {
            if ($this->parse_header)
            {
                foreach ($this->header as $i => $heading_i)
                {
                    $row_new[$heading_i] = $row[$i];
                }
                $data[] = $row_new;
                //$data['name_simulation']=$name_simulation;
            }
            else
            {
                $data[] = $row;
                //$data['name_simulation']=$name_simulation;
            }

            if ($max_lines > 0)
                $line_count++;
        }
        return $data;
    }
    //--------------------------------------------------------------------

}
?>