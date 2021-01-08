<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class RelatedSickness extends Entity
{
    protected $_accessible = [
        'articles_id' => true,
        'sicknesses_id' => true,
        'article' => true,
        'sickness' => true,
    ];
}
