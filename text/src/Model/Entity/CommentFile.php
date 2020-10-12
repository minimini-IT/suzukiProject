<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CommentFile Entity
 *
 * @property int $comment_files_id
 * @property int $crew_send_comments_id
 * @property string $files_name
 * @property string $files_size
 * @property string $files_unique_name
 *
 * @property \App\Model\Entity\CrewSendComment $crew_send_comment
 */
class CommentFile extends Entity
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
        'crew_send_comments_id' => true,
        'file_name' => true,
        'file_size' => true,
        'unique_file_name' => true,
        //'crew_send_comment' => true
        'crew_send_comment' => false
    ];
}
