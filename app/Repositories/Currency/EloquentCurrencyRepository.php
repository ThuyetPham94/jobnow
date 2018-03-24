<?php
namespace App\Repositories\Currency;

use App\Models\Currency;
use App\Repositories\EloquentMainRepository;

class EloquentCurrencyRepository extends EloquentMainRepository implements CurrencyRepository {

	protected $model;

	public function __construct(Currency $model) {
		$this->model = $model;
	}

}