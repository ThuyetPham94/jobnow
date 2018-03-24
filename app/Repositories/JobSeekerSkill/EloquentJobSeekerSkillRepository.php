<?php
namespace App\Repositories\JobSeekerSkill;

use App\Models\JobSeekerSkill;
use App\Repositories\EloquentMainRepository;

class EloquentJobSeekerSkillRepository extends EloquentMainRepository implements JobSeekerSkillRepository {

	protected $model;

	public function __construct(JobSeekerSkill $model) {
		$this->model = $model;
	}

	public function getSkillWithUidAndID($id, $uid){
		return $this->model->where('id', $id)->where('JobSeekerID', $uid)->first();
	}

}