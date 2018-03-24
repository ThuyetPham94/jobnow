<?php
namespace App\Repositories\JobActstatic;

use App\Models\JobActstatic;
use App\Repositories\EloquentMainRepository;

class EloquentJobActstaticRepository extends EloquentMainRepository implements JobActstaticRepository {

	protected $model;

	public function __construct(JobActstatic $model) {
		$this->model = $model;
	}

}