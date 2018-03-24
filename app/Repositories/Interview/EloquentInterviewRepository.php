<?php
namespace App\Repositories\Interview;

use App\Models\Interview;
use App\Repositories\EloquentMainRepository;

class EloquentInterviewRepository extends EloquentMainRepository implements InterviewRepository {

	protected $model;

	public function __construct(Interview $model) {
		$this->model = $model;
	}

}