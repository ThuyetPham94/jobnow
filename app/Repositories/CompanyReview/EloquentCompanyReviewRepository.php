<?php
namespace App\Repositories\CompanyReview;

use App\Models\CompanyReview;
use App\Repositories\EloquentMainRepository;

class EloquentCompanyReviewRepository extends EloquentMainRepository implements CompanyReviewRepository {

	protected $model;

	public function __construct(CompanyReview $model) {
		$this->model = $model;
	}

}