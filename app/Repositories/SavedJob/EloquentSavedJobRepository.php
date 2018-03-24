<?php
namespace App\Repositories\SavedJob;

use App\Models\SavedJob;
use App\Repositories\EloquentMainRepository;

class EloquentSavedJobRepository extends EloquentMainRepository implements SavedJobRepository {

	protected $model;

	public function __construct(SavedJob $model) {
		$this->model = $model;
	}

	public function checkExitsData($user_id, $job_id){
		return $this->model->where('JobSeekerID', '=' ,$user_id)->where('JobID', '=' ,$job_id)->first();
	}

}