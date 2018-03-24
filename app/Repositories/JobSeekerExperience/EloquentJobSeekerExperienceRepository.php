<?php
namespace App\Repositories\JobSeekerExperience;

use App\Models\JobSeekerExperience;
use App\Repositories\EloquentMainRepository;

class EloquentJobSeekerExperienceRepository extends EloquentMainRepository implements JobSeekerExperienceRepository {

	protected $model;

	public function __construct(JobSeekerExperience $model) {
		$this->model = $model;
	}

	public function getExperienceWithUidAndID($id, $uid){
		return $this->model->where('id', $id)->where('JobSeekerID', $uid)->first();
	}

}