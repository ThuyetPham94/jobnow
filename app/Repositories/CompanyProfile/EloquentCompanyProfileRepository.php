<?php
namespace App\Repositories\CompanyProfile;

use App\Models\CompanyProfile;
use App\Repositories\EloquentMainRepository;

class EloquentCompanyProfileRepository extends EloquentMainRepository implements CompanyProfileRepository {

	protected $model;

	public function __construct(CompanyProfile $model) {
		$this->model = $model;
	}

}