<?php

/**
 * @property Model_berlian Model Berlian
 */

class Model_berlian extends CI_Model
{
    public function __construct() {
        $this->load->database();
        $this->load->helper('inflector');
        $this->CI = get_instance();
    }

    public function generate($tableName)
    {
        if ($this->db->table_exists($tableName)) {
            $this->writeDAO($tableName);
        } else {
            echo "ERROR : Your table $tableName is not exist !  \n";
        }
        
    }

    private function writeDAO($tableName)
    {
        $objectName = $this->getObjectName($tableName)."DAO";
        $headerFile = "<?php \n defined('BASEPATH') OR exit('No direct script access allowed'); \n class $objectName{ \n";
        $footerFile = "}";
        $fields = $this->db->list_fields($tableName);
        $data = '';
        foreach ($fields as $key => $field)
        {
            $data = $data."public $".$field."; \n";
        }
        $data = $headerFile.$data.$footerFile;
        if (!write_file('./application/generated/dao/'.$objectName.'.php', $data))
        {
            echo "ERROR : $field not written to file $tableName.php \n";
        }
    }

    private function getObjectName($name)
    {
        return ucfirst(camelize("$name"));
    }

}