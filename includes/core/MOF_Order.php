<?php


class MOF_Order
{
    private $queryBuilder;
    private $orderId;
    private $crateDate;
    private $createUser;
    private $storageName;
    private $city;
    private $proficomId;
    private $sendDate;
    private $receivingDate;
    private $receivingEmail;
    private $taxId;
    private $dateTaxReceiving;
    private $dateModifed;
    private $listNomnclature;
    private $createComments;
    private $receivedComments;
    private $userComments;
    private $status;
    private $state; //active or inactive
	private $fields;

    public function __construct()
    {
		$this->queryBuilder = new MOF_QueryBuilder();
	    $_date = date('Y-m-d H:i:s');
		$this->fields = [
			'crateDate'       => $_date,
			'createUser'      => null,
			'storageName'     => null,
			'city'            => null,
			'proficomId'      => '',
			'sendDate'        => '',
			'receivingDate'   => '',
			'receivingEmail'  => '',
			'taxId'           => '',
			'dateTaxReceiving'=> '',
			'dateModifed'     => '',
			'createComments'  => '',
			'receivedComments'=> '',
			'userComments'    => '',
			'status'          => 'new',
			'state'           => 'active'
		];
    }

    public function create( $items, $comments )
    {
    	$objUser = new MOF_User();
    	$user = $objUser->get();
		$_date = date('Y-m-d H:i:s');
    	$data = wp_parse_args([
    		'crateDate'   => $_date,
		    'createUser'  => $user->email,
		    'storageName' => $user->storage,
		    'city'        => $user->storage,
		    'createComments' => $comments
	    ], $this->fields);
		$id = $this->queryBuilder->insert_order($data);

		foreach ($items as $_item) {
			$this->queryBuilder->insert_order_nomenclature($id, $_date, $_item);
		}
    }
    public function get ()
    {
	    return $this->queryBuilder->getOrders();
    }

}