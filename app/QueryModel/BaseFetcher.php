<?php

declare(strict_types=1);

namespace App\QueryModel;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Support\Facades\Event;

abstract class BaseFetcher
{
    protected function setCustomObjectMode(string $object)
    {
        Event::listen(StatementPrepared::class, function ($event) use($object) {
            $event->statement->setFetchMode(\PDO::FETCH_CLASS, $object);
        });
    }

}
