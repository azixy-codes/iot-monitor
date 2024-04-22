<?php

namespace App\View\Components;

use App\Models\Module;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BarChart extends Component
{

    public function __construct(
        public Module $module,
        public array $chartData = []
    ) {
    }

    public function init()
    {
        $records = $this->last_records();

        if (count($records) > 0) {
            foreach ($records as $record) {
                $this->chartData['labels'][] =  $record['time'];
                $this->chartData['data'][] =  $record['value_mesuree'];
            }
        } else {
            $this->chartData = [
                'labels' => ['00:00', '01:00', '02:00', '03:00', '04:00'],
                'data' => [0, 0, 0, 0, 0]
            ];
        }
    }

    public function last_records(int $limit = 5)
    {
        $filtred_records = $this->module->historique->sortByDesc('created_at')->take($limit)->select(['valeur_mesuree', 'created_at'])->reverse();

        $last_records = $filtred_records->map(function ($record) {
            return [
                'value_mesuree' => $record['valeur_mesuree'],
                'time' =>  Carbon::parse($record['created_at'])->toDateTimeString('second')
            ];
        })->toArray();

        return $last_records;
    }

    public function render(): View|Closure|string
    {
        $this->init();
        return view('components.bar-chart');
    }
}
