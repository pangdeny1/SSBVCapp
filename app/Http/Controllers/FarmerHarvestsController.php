<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Farmer;
use App\Harvest;
use App\Http\Requests\HarvestCreateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FarmerHarvestsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * @param Farmer $farmer
     * @return View
     * @throws AuthorizationException
     */
    public function index(Farmer $farmer)
    {
        $this->authorize("view", Farmer::class);

        return view("farmers.harvests.index", compact("farmer"));
    }

    /**
     * @param Farmer $farmer
     * @return View
     * @throws AuthorizationException
     */
    public function create(Farmer $farmer)
    {
        $this->authorize("create", $farmer);

        return view("farmers.harvests.create", compact("farmer"));
    }

    public function store(HarvestCreateRequest $request, Farmer $farmer)
    {
        $harvest = Harvest::create($request->only([
            "expected_amount",
            "amount_unit",
            "expected_date",
            "block_id",
            "description",
            "batch_id"
        ]));

        $harvest->update(["farmer_id" => $farmer->id]);

        return redirect()->route("farmers.show", $farmer);
    }
}
