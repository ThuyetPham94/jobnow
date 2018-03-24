<?php
namespace App\Repositories\CompanyImage;

use App\Models\CompanyImage;
use App\Repositories\EloquentMainRepository;

class EloquentCompanyImageRepository extends EloquentMainRepository implements CompanyImageRepository {

	protected $model;

	public function __construct(CompanyImage $model) {
		$this->model = $model;
	}

}