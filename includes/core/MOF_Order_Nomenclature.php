<?php


class MOF_Order_Nomenclature
{
    private $nomenclature;
    protected $order;
    protected $query_buolder;

    public function __construct( $order ) {
    	$this->order = $order;
    	$this->query_buolder = new MOF_QueryBuilder();
    	$this->getNomenclature();
    }
    public  function getOrderNomenclature ()
    {
    	return $this->nomenclature;
    }
    protected function getNomenclature()
    {
    	$this->nomenclature = $this->query_buolder->getOrderNomenclature($this->order->orderId);
    }

}