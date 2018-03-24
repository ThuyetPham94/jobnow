<?php
namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Repositories\EloquentMainRepository;

class EloquentNotificationRepository extends EloquentMainRepository implements NotificationRepository {

	protected $model;

	public function __construct(Notification $model) {
		$this->model = $model;
	}

}