<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $dept
 * @property string $speciality
 *
 * @property \App\Model\Entity\Journal[] $journals
 */
class User extends Entity
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
        'email' => true,
        'name' => true,
        'password' => true,
        'dept' => true,
        'speciality' => true,
        'journals' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    //hash user's password
    protected function _setPassword($password)
      {
          if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
          }
      }
}
