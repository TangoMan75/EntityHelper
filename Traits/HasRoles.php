<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait HasRoles
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait HasRoles
{

    /**
     * @var array
     * @ORM\Column(type="simple_array", nullable=true)
     */
    protected $roles = [];

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return array $roles
     */
    public function getRoles()
    {
        // Every user has "ROLE_USER"
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';

            return $this->roles;
        }

        if ( ! in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($this->roles);
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        $role = strtoupper($role);

        if ($role == 'ROLE_USER') {
            return true;
        }

        if (in_array($role, $this->roles)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function addRole($role)
    {
        $role = strtoupper($role);

        if ( ! in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function removeRole($role)
    {
        $role = strtoupper($role);

        $roles = $this->roles;

        if (in_array($role, $roles)) {
            $remove[]    = $role;
            $this->roles = array_diff($roles, $remove);
        }

        return $this;
    }
}
