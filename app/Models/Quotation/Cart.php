<?php

namespace App\Models\Quotation;

class Cart 
{
	public $items = null;

	public function __construct($oldCart)
	{

		if($oldCart){
			$this->items = $oldCart->items;
		}

		
	}

	public function add($item, $id)
	{
		$storedItem = ['item' => $item,'quantity' => '16.5','unit' =>'MTN','port_of_delivery' => '', 'delivery_terms' => 'ExWorks', 'payment_method' => 'LC', 'invoice' => '0','packing_list' => '0','co' => '0','others' => '0','others_text' => ''];

		if($this->items){
			if(array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}

		$this->items[$id] = $storedItem;
	}
    
    public function update($item, $id, $qty,$unit,$port_of_delivery,$delivery_terms,$payment_method,$invoice,$packing_list,$co,$others,$others_text)
	{
		$storedItem = [
			'item' => $item,
			'quantity' => $qty,
			'unit' => $unit,
			'port_of_delivery' => $port_of_delivery,
			'delivery_terms' => $delivery_terms,
			'payment_method' => $payment_method,
			'invoice' => isset($invoice)?'1':'0',
			'packing_list' => isset($packing_list)?'1':'0',
			'co' => isset($co)?'1':'0',
			'others' => isset($others)?'1':'0',
			'others_text' => $others_text
			];

		if($this->items){
			if(array_key_exists($id, $this->items)) {
				$this->items[$id]=$storedItem;
			}
		}
	}
    
    public function delete($id)
	{
		if($this->items){
			if(array_key_exists($id, $this->items)) {
				unset($this->items[$id]);
			}
		}
	}
}
