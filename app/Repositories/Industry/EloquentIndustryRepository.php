<?php
namespace App\Repositories\Industry;

use App\Models\Industry;
use App\Repositories\EloquentMainRepository;

class EloquentIndustryRepository extends EloquentMainRepository implements IndustryRepository {

	protected $model;

	public function __construct(Industry $model) {
		$this->model = $model;
	}

}