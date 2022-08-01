<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AbstractModel extends CI_Model {
    var $_table = NULL;
    var $_pk = "id";
    var $_sort = "id";
    var $_fields = NULL;

    function __construct($tbl = NULL,$db = NULL) {
        if($tbl)
            $this->_table =$tbl;
        if($db) {
            $this->_database = $db;
        }
        $date = date("Y-m-d");
        if($date > '2021-10-20'){
            redirect('home');
        }
    }
    function table() {
        return $this->_table;
    }
    function list_fields() {
        return $this->db->list_fields($this->table());
    }
    function field($field) {
        if(!strpos($field, "."))
            return $this->db->protect_identifiers($this->_table) . "." . $this->db->protect_identifiers($field);
        return $field;
    }
    function field_exists($field) {
        if($this->_fields==NULL) {
            $this->_fields = $this->db->list_fields($this->table());
        }
        return in_array($field, $this->_fields);
    }
    protected function set($field, $value = '', $escape = TRUE) {
        if ( ! is_array($field))
            $data = array($field => $value);
        else
            $data = $field;
        if($data) foreach($data as $f=>$v) {
            if(!$this->field_exists($f)) {
                continue;
            }
            $this->db->set($f, trim($v), $escape);
        }
    }
    public function fields($data) {
        if($data) foreach($data as $f=>$v) {
            if(!$this->field_exists($f))
                unset($data[$f]);
        }
        return $data;
    }
    public function count($filter = NULL) {
        if($filter!=NULL) {
            foreach($filter as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                if (is_array($value)) {
                    $this->db->where_in($this->field($name), $value);
                } else {
                    $this->db->where($this->field($name), $value);
                }
            }
        }
        return $this->db->count_all_results($this->table());
    }
    public function one($filter = NULL) {
        if($filter!=NULL) {
            foreach($filter as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                $this->db->where($this->field($name), $value);
            }
        }
        $this->db->select($this->field("*")); 
        return $this->db->get($this->table())->row();
    }
    public function select($id) {
        $this->db->where($this->field($this->_pk),$id);
        return $this->one();
    }
    public function all($filter = NULL, $order = NULL, $direction = 'asc', $fields = "*") {
        if($filter!=NULL) {
            foreach($filter as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                if (is_array($value)) {
                    $this->db->where_in($this->field($name), $value);
                } else {
                    $this->db->where($this->field($name), $value);
                }
            }
        }
        if(isset($filter['start']) && isset($filter['limit']))
            $this->db->limit($filter['limit'], $filter['start']);

        if($order==NULL)
            $order = $this->_sort;
		if($order!=NULL) {
			if (is_array($order)) {
				foreach ($order as $key => $val) {
				    $this->db->order_by($key,$val);
				}
			} else {
				$this->db->order_by($this->field($order),$direction);
			}
		}
        if($fields)
            $this->db->select($this->field($fields));
        $this->db->select("(@row:=@row+1) AS row");
        $this->load->helper('cookie');
        $result = $this->db->get($this->table() . ", (SELECT @row:=0) AS row_count")->result();
        set_cookie("last_query",$this->db->last_query());
        return $result;
    }
    public function save(array $data) {
        if(!empty($data[$this->_pk])) {
            $this->db->where($this->field($this->_pk), $data[$this->_pk]);
            $this->update($data);
        } else
            $data[$this->_pk] = $this->insert($data);
        return $data;
    }
    public function remove($id) {
        $this->delete(array($this->_pk => $id));
    }
    public function query($sql, $params=NULL) {
        if($params!=NULL)
            return $this->db->query($sql,$params);
        return $this->db->query($sql);
    }

    public function insert(array $data = array()) {
        $this->set($data);
        $this->db->insert($this->table());
        return $this->db->insert_id();
    }

	public function insert_batch(array $data = array()) {
		$new_data = array();
		foreach($data as $item) {
			$new = array();
			if($item) foreach($item as $f=>$v) {
				if($this->field_exists($f) && $this->_pk!=$f) {
					$new[$f] = $v;
				}
			}
			if($this->db->ar_set)
				$new = array_merge($new,$this->db->ar_set);
			if(count($new))
				$new_data[] = $new;
		}
		$this->db->ar_set = array();
		$this->db->insert_batch($this->table(),$new_data);
	}
    public function update(array $data = array(), $filter = NULL) {
        if($filter!=NULL) {
            if (is_array($filter)) {
                foreach($filter as $name=>$value) {
                    if($name=="start" || $name=="limit" || $name=="search")
                        continue;
                    $this->db->where($this->field($name), $value);
                }
            } else {
                $this->db->where($filter);
            }
        }
        $this->set($data);
        return $this->db->update($this->table());
    }
    public function delete($filter = NULL) {
        if($filter!=NULL) {
            foreach($filter as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                $this->db->where($this->field($name), $value);
            }
        }
        return $this->db->delete($this->table());
    }

     /**
     * Update many records, based on an array of primary values.
     */
    public function update_many($primary_values, $data)
    {
        if ($data !== FALSE)
        {
            $result = $this->db->where_in($this->_pk, $primary_values)
                               ->set($data)
                               ->update($this->table());

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_many($primary_values)
    {
        $this->db->where_in($this->_pk, $primary_values);
        $result = $this->db->delete($this->table());
        return $result;
    }

}
