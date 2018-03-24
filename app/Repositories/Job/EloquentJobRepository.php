<?php
namespace App\Repositories\Job;

use App\Models\Job;
use App\Repositories\EloquentMainRepository;

class EloquentJobRepository extends EloquentMainRepository implements JobRepository {

	protected $model;

	public function __construct(Job $model) {
		$this->model = $model;
	}

	public function count(){
		return $this->model->count();
	}

}