<?php
class Admin_Products_model extends CI_Model {
    
    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct()
    {
        $this->load->database();
    }
    
    /**
     * Get product by his is
     * @param int $product_id
     * @return array
     */
    public function get_product_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Fetch products data from the database
     * possibility to mix search, filter and order
     * @param int $manufacuture_id
     * @param string $search_string
     * @param string $order
     * @param string $order_type
     * @param int $limit_start
     * @param int $limit_end
     * @return array
     */
    public function get_products($manufacture_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
        
        $this->db->select('products.id');
        $this->db->select('products.name');
        $this->db->select('products.age');
        $this->db->select('products.phone');
        $this->db->select('products.comingfrom');
        $this->db->select('products.purpose');
        $this->db->select('products.checkin');
        $this->db->select('products.address');
        $this->db->select('products.checkout');
        $this->db->select('products.adhar');
        $this->db->select('products.email');
        $this->db->select('products.belongings');
        
        
        $this->db->from('products');
        if($manufacture_id != null && $manufacture_id != 0){
            $this->db->where('manufacture_id', $manufacture_id);
        }
        if($search_string){
            $this->db->like('name', $search_string);
        }
        
        
        $this->db->group_by('products.id');
        
        if($order){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('id', $order_type);
        }
        
        
        $this->db->limit($limit_start, $limit_end);
        //$this->db->limit('4', '4');
        
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    /**
     * Count the number of rows
     * @param int $manufacture_id
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_products($manufacture_id=null, $search_string=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('products');
        if($manufacture_id != null && $manufacture_id != 0){
            $this->db->where('manufacture_id', $manufacture_id);
        }
        if($search_string){
            $this->db->like('name', $search_string);
        }
        if($order){
            $this->db->order_by($order, 'Asc');
        }else{
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /**
     * Store the new item into the database
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function store_product($data)
    {
        $insert = $this->db->insert('products', $data);
        return $insert;
    }
    
    /**
     * Update product
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_product($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('products', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Delete product
     * @param int $id - product id
     * @return boolean
     */
    function delete_product($id){
        $this->db->where('id', $id);
        $this->db->delete('products');
    }
    function checkout_visitor($cid, $checkout_date)
    {
        $this->db->where('id', $cid);
        $this->db->update('products', $checkout_date);
    }
    
}
?>

