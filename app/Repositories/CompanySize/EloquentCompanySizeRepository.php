<?php
namespace App\Repositories\CompanySize;

use App\Models\CompanySize;
use App\Repositories\EloquentMainRepository;

class EloquentCompanySizeRepository extends EloquentMainRepository implements CompanySizeRepository {

	protected $model;

	public function __construct(CompanySize $model) {
		$this->model = $model;
	}

}