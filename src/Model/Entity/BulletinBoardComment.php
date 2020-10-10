<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BulletinBoardComment Entity
 *
 * @property int $bulletin_board_comments_id
 * @property int $bulletin_boards_id
 * @property string $comment_author
 * @property string $comment_contents
 *
 * @property \App\Model\Entity\BulletinBoard $bulletin_board
 */
class BulletinBoardComment extends Entity
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
        'bulletin_boards_id' => true,
        'comment_author' => true,
        'comment_contents' => true,
        'bulletin_board' => true,
    ];
}
