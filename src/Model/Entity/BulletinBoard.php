<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class BulletinBoard extends Entity
{
    protected $_accessible = [
        'title' => true,
        'author' => true,
        'contents' => true,
    ];

    protected function _getCommentModified()
    {
        foreach($this->bulletin_board_comments as $comment)
        {
            $comment_modified = $comment->modified;
            return $comment_modified;
        }
    }
}
