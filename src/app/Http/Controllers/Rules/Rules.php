<?php

namespace App\Http\Controllers\Rules;

use App\Enum\RulesEnum;
use App\Http\Controllers\Controller;
use App\Models\Agencies as AgenciesModel;
use App\Models\Conditions;
use App\Models\Hotel;
use App\Models\Rules as RulesModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Rules extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('rules.list_hotels', compact('hotels'));
    }

    public function create()
    {
        return view('rules.create', [
            'objects' => RulesEnum::cases(),
            'conditions' => RulesEnum::getConditionsList(),
            'inputOptions' => RulesEnum::getTypeInputList(),
            'agencies' => AgenciesModel::getAgenciesList()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'agency_id' => 'required',
            'object' => 'required',
            'condition' => 'required',
            'equality' => 'required',
            'text' => 'required',
        ]);

        $object = $request->all()['object'];
        $conditions = $request->all()['condition'];
        $equality = $request->all()['equality'];

        $rule = RulesModel::saveModel($request->all());
        Conditions::saveModel($rule, $object, $conditions, $equality);

        return redirect()->route('index');
    }

    /**
     * @deprecated
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'agency_id' => 'required',
            'object' => 'required',
            'condition' => 'required',
            'equality' => 'required',
            'text' => 'required',
        ]);

        $idCondition = Conditions::updateModel($request->all(), $id);
        $idRules = RulesModel::updateModel($request->all(), $idCondition);

        return redirect()->route('edit', ['id' => $idRules])
            ->with('success', 'Rules updated successfully.');

    }

    /**
     * @deprecated
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(int $id)
    {
        $rule = RulesModel::find($id);
        $conditionModel = $rule->condition;

        return view('rules.update', [
            'rule' => $rule,
            'objects' => RulesEnum::cases(),
            'conditions' => RulesEnum::getConditionsList(),
            'inputOptions' => RulesEnum::getTypeInputList(),
            'agencies' => AgenciesModel::getAgenciesList(),
            'conditionModel' => $conditionModel
        ]);
    }
}
