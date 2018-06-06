<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Journal Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $loginT
 * @property \Cake\I18n\FrozenTime $openT
 * @property \Cake\I18n\FrozenTime $closeT
 * @property \Cake\I18n\FrozenTime $logoutT
 * @property string $content
 * @property string $comment
 *
 * @property \App\Model\Entity\User $user
 */
class Journal extends Entity
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
        'user_id' => true,
        'date' => true,
        'loginT' => true,
        'openT' => true,
        'closeT' => true,
        'logoutT' => true,
        'content' => true,
        'comment' => true,
        'user' => true
    ];
}
