<?php
namespace App\Repositories\Skill;

use App\Models\Skill;
use App\Repositories\EloquentMainRepository;

class EloquentSkillRepository extends EloquentMainRepository implements SkillRepository {

	protected $model;

	public function __construct(Skill $model) {
		$this->model = $model;
	}

}