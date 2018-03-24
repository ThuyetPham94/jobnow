<?php
namespace App\Repositories\JobSkill;

use App\Models\JobSkill;
use App\Repositories\EloquentMainRepository;

class EloquentJobSkillRepository extends EloquentMainRepository implements JobSkillRepository {

	protected $model;

	public function __construct(JobSkill $model) {
		$this->model = $model;
	}

}