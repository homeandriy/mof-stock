<?php


class MOF_Nomenclature
{
    private $odj;
    private $query_factory;

    public function __construct()
    {
        $this->query_factory = new MOF_QueryBuilder();
    }

	public function setRow( $_rowObject )
    {
        $this->odj = $_rowObject;
    }
    public function getName()
    {
        $this->odj->name;
    }
    public function  getTypePay()
    {
        $this->odj->type_pay;
    }
    public function getAll ()
    {
        return $this->query_factory->getAllNomenclature();
    }
    public function prepareNomenclature ( $post )
    {
        $this->odj = (object) array(
            'name'      => $post['itemName'],
            'type_pay'  => $post['type_pay']
        );
        return $this;
    }
    public function  insertNomenclature ()
    {
        return $this->query_factory->insertNomenclature($this->odj);
    }

    public function getOrderNomenclature ($orderID)
    {
        return $this->query_factory->getOrderNomenclature( $orderID );
    }

}