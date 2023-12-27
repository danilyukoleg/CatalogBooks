<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasRoleAndPermissions
{
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}

	/**
	 * @return mixed
	 */
	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'users_permissions');
	}

	public function hasRole(...$roles)
	{
		foreach ($roles as $role) {
			if ($this->roles->contains('slug', $role)) {
				return true;
			}
		}
		return false;
	}

	public function hasPermission($permission)
	{
		return (bool)$this->permissions->where('slug', $permission)->count();
	}

	public function hasPermissionTo($permission)
	{
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->slug);
	}

	public function hasPermissionThroughRole($permission)
	{
		foreach ($permission->roles as $role) {
			if ($this->roles->contains($role)) {
				return true;
			}
		}
		return false;
	}

	public function getAllPermissions(array $permissions)
	{
		return Permission::whereIn('slug', $permissions)->get();
	}

	public function getAllRoles(array $roles)
	{
		return Role::whereIn('slug', $roles)->get();
	}

	public function givePermissionsTo(...$permissions)
	{
		$permissions = $this->getAllPermissions($permissions);
		if ($permissions === null) {
			return $this;
		}
		$this->permissions()->saveMany($permissions);
		return $this;
	}

	public function giveRoleTo(...$roles)
	{
		$roles = $this->getAllRoles($roles);

		if ($roles === null) {
			return $this;
		}
		$this->roles()->saveMany($roles);
		return $this;
	}

}
