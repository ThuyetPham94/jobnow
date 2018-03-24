<?php
namespace App\Repositories\User;

use App\User;
use App\Repositories\EloquentMainRepository;

class EloquentUserRepository extends EloquentMainRepository implements UserRepository {

	protected $model;

	public function __construct(User $model) {
		$this->model = $model;
	}

}