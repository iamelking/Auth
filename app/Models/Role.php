<?php 

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends EntrustRole
{
	use EntrustRoleTrait;


	protected $guarded=[];
}