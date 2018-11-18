<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockMovementItem Entity
 *
 * @property int $item_id
 * @property int $stock_movement_id
 * @property int $quantity
 * @property int $unit_id
 * @property int $id
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\StockMovement $stock_movement
 * @property \App\Model\Entity\Unit $unit
 */
class StockMovementItem extends Entity
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
        'item_id' => true,
        'stock_movement_id' => true,
        'quantity' => true,
        'unit_id' => true,
        'item' => true,
        'stock_movement' => true,
        'unit' => true
    ];
}
