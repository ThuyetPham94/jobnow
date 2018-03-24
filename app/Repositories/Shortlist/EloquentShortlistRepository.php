<?php
namespace App\Repositories\Shortlist;

use App\Models\Shortlist;
use App\Repositories\EloquentMainRepository;

class EloquentShortlistRepository extends EloquentMainRepository implements ShortlistRepository {

	protected $model;

	public function __construct(Shortlist $model) {
		$this->model = $model;
	}

}