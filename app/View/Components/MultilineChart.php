<?php

namespace App\View\Components;

use App\Models\Module;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class MultilineChart extends Component
{
    public function __construct(
        public Collection $modules,
        public array $chartData = []
    ) {
    }

    public function init(int $limit = 3)
    {
        $last_modules = $this->modules->sortByDesc('created_at')->take($limit);

        if (count($last_modules) > 0) {
            foreach ($last_modules as $module) {
                $filtred_values = $module->historique->sortByDesc('created_at')->take(10)->select(['valeur_mesuree', 'created_at'])->reverse();

                $final_values = $filtred_values->map(function ($record) {
                    return [
                        'value_mesuree' => $record['valeur_mesuree'],
                        'time' =>  Carbon::parse($record['created_at'])->toTimeString('minute')
                    ];
                })->toArray();

                if (count($final_values) > 0) {
                    $this->chartData[$module->id]['nom'] =  $module->nom;
                    $this->chartData[$module->id]['type'] =  $module->type_de_mesure->nom;
                    foreach ($final_values as $value) {
                        $this->chartData[$module->id]['labels'][] =  $value['time'];
                        $this->chartData[$module->id]['data'][] =  $value['value_mesuree'];
                    }
                } else {
                    $this->chartData = [
                        'data' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    ];
                }
            }
        }
    }

    public function render(): View|Closure|string
    {

        $this->init();
        return view('components.multiline-chart');
    }
}
