<?php 

namespace App\Repositories;

class EloquentMainRepository {
	
	public function get() {
		return $this->model->get();
	}

	public function first() {
		return $this->model->first();
	}

	public function getAll() {
		return $this->model->all();
	}

	public function getById($id) {
		return $this->model->find($id);
	}

	public function create(array $attr) {
		return $this->model->create($attr);
	}

	public function update($id, array $attr) {
		$data = $this->model->findOrfail($id);
		$data->update($attr);
		return $data;
	}

	public function delete($id) {
		$this->getById($id)->delete();
		return true;
	}

	public function where($first, $comparisons = null, $val = null) {
		return $this->model->where($first, $comparisons, $val);
	}

	//orwhere
    public function orwhere($first, $comparisons = null, $val = null) {
        return $this->model->orwhere($first, $comparisons, $val);
    }
    //end

    //orwhere and where
    public function orAndwhere($first, $comparisons = null, $val = null) {
        return $this->model
            ->orwhere($first, $comparisons, $val);
    }

	public function whereHas($relation, $callback) {
		return $this->model->whereHas($relation, $callback);
	}

	public function paginate($page) {
		return $this->model->paginate($page);
	}

	public function lists($val1 , $val2) {
		return $this->model->lists($val1 , $val2);
	}

	public function orderBy($col = 'id', $condition = 'ASC') {
		return $this->model->orderBy($col, $condition);
	}
	public function count(){
		return $this->model->count();
	}

	public function with(array $with = []) {
		return $this->model->with($with);
	}
        
        public function InnerJoin(){
            
        }
}
