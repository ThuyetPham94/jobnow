<?php
namespace App\Repositories\Feedback;

use App\Models\Feedback;
use App\Repositories\EloquentMainRepository;

class EloquentFeedbackRepository extends EloquentMainRepository implements FeedbackRepository {

	protected $model;

	public function __construct(Feedback $model) {
		$this->model = $model;
	}

}