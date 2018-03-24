<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\EloquentMainRepository;

class EloquentCategoryRepository extends EloquentMainRepository implements CategoryRepository {

	protected $model;

	public function __construct(Category $model) {
		$this->model = $model;
	}

}