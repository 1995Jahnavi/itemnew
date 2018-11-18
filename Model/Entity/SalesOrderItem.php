<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesOrderItem Entity
 *
 * @property int $id
 * @property int $sales_order_id
 * @property int $item_id
 * @property int $unit_id
 * @property int $quantity
 * @property int $rate
 * @property int $amount
 * @property int $warehouse_id
 *
 * @property \App\Model\Entity\SalesOrder $sales_order
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\Warehouse $warehouse
 */
class SalesOrderItem extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'sales_order_id' => true,
        'item_id' => true,
        'unit_id' => true,
        'quantity' => true,
        'rate' => true,
        'amount' => true,
        'warehouse_id' => true,
        'sales_order' => true,
        'item' => true,
        'unit' => true,
        'warehouse' => true
    ];
}
