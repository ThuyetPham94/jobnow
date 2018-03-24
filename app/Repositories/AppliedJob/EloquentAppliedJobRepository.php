<?php
namespace App\Repositories\AppliedJob;

use App\Models\AppliedJob;
use App\Repositories\EloquentMainRepository;

class EloquentAppliedJobRepository extends EloquentMainRepository implements AppliedJobRepository {

	protected $model;

	public function __construct(AppliedJob $model) {
		$this->model = $model;
	}
	public function checkExitsData($user_id, $job_id){
		return $this->model->where('JobSeekerID', '=' ,$user_id)->where('JobID', '=' ,$job_id)->first();
	}

}