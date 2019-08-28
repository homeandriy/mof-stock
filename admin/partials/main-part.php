<?php
$ordersInit = new MOF_Order();

$orders = $ordersInit->get();
$d = date('d-m-Y');
$i = 1;

$data = $ordersInit->get_order(2);
$_nomenclature = new MOF_Order_Nomenclature( $data) ;
?>

<diw class="wrap">
	<h2>Головне меню замовлень</h2>
	<table class="widefat table">
		<thead>
            <tr>
                <th>№</th>
                <th><?php _e('Order id', 'mof-sclad');?></th>
                <th><?php _e('customer', 'mof-sclad');?></th>
                <th><?php _e('city', 'mof-sclad');?></th>
                <th><?php _e('create date', 'mof-sclad');?></th>
                <th><?php _e('Proficom date', 'mof-sclad');?></th>
                <th><?php _e('Send date', 'mof-sclad');?></th>
                <th><?php _e('Comment', 'mof-sclad');?></th>
                <th><?php _e('Tax id', 'mof-sclad');?></th>
                <th><?php _e('Tax id receiving date', 'mof-sclad');?></th>
                <th><?php _e('Status', 'mof-sclad');?></th>
                <th><?php _e('State', 'mof-sclad');?></th>
            </tr>
        </thead>
		<tbody>
			<?php foreach ($orders as $_order) : ?>
			<tr>
                <td><?php echo $i; ?></td>
                <td>ORD-<?php echo $d; ?>-<?php echo $_order->orderId; ?></td>
                <td>
                    <p><?php echo $_order->createUser; ?></p>
                </td>
                <td><?php echo $_order->city; ?></td>
                <td><?php echo $_order->crateDate; ?></td>
                <td><?php echo $_order->proficomId; ?></td>
                <td><?php echo $_order->sendDate; ?></td>
                <td><?php echo $_order->createComments; ?></td>
                <td><?php echo $_order->taxId; ?></td>
                <td><?php echo $_order->dateTaxReceiving; ?></td>
                <td><?php echo $_order->status; ?></td>
                <td><?php echo $_order->state; ?></td>

			</tr>
			<?php endforeach; $i++;?>
		</tbody>
	</table>
	<pre>
        <?php print_r($data);?>
		<?php print_r($_nomenclature->getOrderNomenclature());?>
	</pre>
</diw>
