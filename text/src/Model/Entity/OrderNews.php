<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderNews Entity
 *
 * @property int $order_news_id
 * @property \Cake\I18n\FrozenDate $order_news_date
 * @property string $title
 * @property string|null $comment
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class OrderNews extends Entity
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
        'order_news_date' => true,
        'title' => true,
        'comment' => true,
        'created' => true,
        'modified' => true
    ];
}
