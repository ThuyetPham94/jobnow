<?php
namespace App\Repositories\Location;

use App\Models\Location;
use App\Repositories\EloquentMainRepository;

class EloquentLocationRepository extends EloquentMainRepository implements LocationRepository {

	protected $model;

	public function __construct(Location $model) {
		$this->model = $model;
	}

}