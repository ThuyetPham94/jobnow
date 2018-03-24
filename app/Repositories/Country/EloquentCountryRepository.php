<?php
namespace App\Repositories\Country;

use App\Models\Country;
use App\Repositories\EloquentMainRepository;

class EloquentCountryRepository extends EloquentMainRepository implements CountryRepository {

	protected $model;

	public function __construct(Country $model) {
		$this->model = $model;
	}

}