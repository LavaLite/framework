<?php

namespace Litepie\Master;

use Litepie\Master\Models\Master as ModelsMaster;

class Master
{
    private $master;

    /**
     * Constructor .
     */
    public function __construct(
    ) {
        $this->master = app(ModelsMaster::class);
    }

    /**
     * Returns count of master.
     *
     * @param array $filter
     *
     * @return int
     */
    public function select(string | array $type, $value = 'code')
    {
        if (is_array($type)) {
            $rows = $this->master->with('parent')->whereIn('type', $type)->get();
        } else {
            $rows = $this->master->with('parent')->where('type', $type)->get();
        }
        return $rows->map(function ($item, int $key) use ($value) {
            return [
                'value' => $item->$value,
                'text' => $item->name,
                'key' => $item->id,
                'group' => $item->parent?->code,
                'more' => $item->toArray(),
            ];
        })->toArray();

    }
}
