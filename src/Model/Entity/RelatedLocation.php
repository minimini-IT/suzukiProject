<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RelatedLocation Entity
 *
 * @property int $related_locations_id
 * @property int $articles_id
 * @property int $locations_id
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Location $location
 */
class RelatedLocation extends Entity
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
        'articles_id' => true,
        'locations_id' => true,
        'article' => true,
        'location' => true,
    ];
}
