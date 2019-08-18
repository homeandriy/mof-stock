<?php


class MOF_QueryBuilder
{
    private $user;
    private $tableNomenclature;
    private $tableOrders;
    private $serviceOrders;

    public function __construct( MOF_User $user = null )
    {
        $this->user = $user;
        global $wpdb;
        $this->tableNomenclature = $wpdb->prefix.'nomenclature';
        $this->tableOrders = $wpdb->prefix.'orders';
        $this->serviceOrders = $wpdb->prefix.'ordered_nomenclature';
    }
    public function insertNomenclature ( $data )
    {
        global $wpdb;
        if($this->findNomenclature($data->name)) return false;

        return $wpdb->insert($this->tableNomenclature,[
            'name'     => $data->name,
            'type_pay' => $data->type_pay
        ]);
    }
    public function getAllNomenclature (){
	    global $wpdb;
	    return $wpdb->get_results("SELECT * FROM {$this->tableNomenclature}");
    }
    public function findNomenclature( $name )
    {
        global $wpdb;
        $res = $wpdb->get_row("SELECT * FROM {$this->tableNomenclature} WHERE name = '{$name}'");
        return $res;
    }
    public function getOrderNomenclature ( $orderID ){
        global $wpdb;
        return $wpdb->get_results($wpdb->prepare("SELECT * FROM {$this->serviceOrders} WHERE order_id = ?", [$orderID]));
    }
    public function insert_order($data)
    {
    	global $wpdb;
        return	$wpdb->insert( $this->tableOrders, $data );
    }
    public function insert_order_nomenclature ( int $orderId, $_date, array $item )
    {
	    global $wpdb;
	    return	$wpdb->insert( $this->serviceOrders, [
	    	'orderID'        => $orderId,
		    'nomenclatureID' => $item['id'],
		    'amount'         => $item['amount'],
		    'priority'        => $item['priority']

	    ] );
    }
    public function getOrders ()
    {
	    global $wpdb;
	    return $wpdb->get_results("SELECT * FROM {$this->tableOrders}");
    }
}