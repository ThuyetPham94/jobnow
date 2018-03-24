<?php
namespace App\Repositories\CompanyIndustry;

use App\Models\CompanyIndustry;
use App\Repositories\EloquentMainRepository;

class EloquentCompanyIndustryRepository extends EloquentMainRepository implements CompanyIndustryRepository {

	protected $model;

	public function __construct(CompanyIndustry $model) {
		$this->model = $model;
	}

}