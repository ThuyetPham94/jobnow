<?php
namespace App\Repositories\JobSeeker;

use App\Models\JobSeeker;
use App\Repositories\EloquentMainRepository;

class EloquentJobSeekerRepository extends EloquentMainRepository implements JobSeekerRepository {

	protected $model;

	public function __construct(JobSeeker $model) {
		$this->model = $model;
	}

}