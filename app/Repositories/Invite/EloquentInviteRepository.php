<?php
namespace App\Repositories\Invite;

use App\models\Invite;
use App\Repositories\EloquentMainRepository;

class EloquentInviteRepository extends EloquentMainRepository implements InviteRepository {

	protected $model;

	public function __construct(Invite $model) {
		$this->model = $model;
	}

}