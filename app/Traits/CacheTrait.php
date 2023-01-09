<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use GeneaLabs\LaravelModelCaching\CacheTags;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

trait CacheTrait
{
	use Cachable;

	protected function makeCacheTags(): array
	{
		$eagerLoad = $this->eagerLoad ?? [];
        $model = $this->model instanceof Model ? $this->model : $this; // edited
        $query = $this->query instanceof Builder ? $this->query : app(Builder::class);
        $tags = (new CacheTags($eagerLoad, $model, $query->getQuery()))->make();

        return $tags;
    }
}
