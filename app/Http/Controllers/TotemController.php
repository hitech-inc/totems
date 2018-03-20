<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateTotemRequest;
use App\Http\Requests\UpdateTotemRequest;
use App\Models\Totem;
use App\Repositories\TotemRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TotemController extends AppBaseController
{
    /** @var  TotemRepository */
    private $totemRepository;

    public function __construct(TotemRepository $totemRepo)
    {
        $this->totemRepository = $totemRepo;
    }

    /**
     * Display a listing of the Totem.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->totemRepository->pushCriteria(new RequestCriteria($request));
        $totems = $this->totemRepository->all();

        // check statuses
        // rule: if updated_at > 5 min -> offline
        $now = Carbon::now();

        foreach ($totems as $key => $totem)
        {
            if ($now->diffInSeconds($totem->last_seen_at) > 5 * 60) 
            {
                $totem->status = 'offline';
                $totem->save();
            }
        }

        return view('totems.index')
            ->with('totems', $totems);
    }

    /**
     * Show the form for creating a new Totem.
     *
     * @return Response
     */
    public function create()
    {
        return view('totems.create');
    }

    /**
     * Store a newly created Totem in storage.
     *
     * @param CreateTotemRequest $request
     *
     * @return Response
     */
    public function store(CreateTotemRequest $request)
    {
        $input = $request->all();

        $totem = $this->totemRepository->create($input);

        Flash::success('Totem saved successfully.');

        return redirect(route('totems.index'));
    }

    /**
     * Display the specified Totem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $totem = $this->totemRepository->findWithoutFail($id);

        if (empty($totem)) {
            Flash::error('Totem not found');

            return redirect(route('totems.index'));
        }

        return view('totems.show')->with('totem', $totem);
    }

    /**
     * Show the form for editing the specified Totem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $totem = $this->totemRepository->findWithoutFail($id);

        if (empty($totem)) {
            Flash::error('Totem not found');

            return redirect(route('totems.index'));
        }

        return view('totems.edit')->with('totem', $totem);
    }

    /**
     * Update the specified Totem in storage.
     *
     * @param  int              $id
     * @param UpdateTotemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTotemRequest $request)
    {
        $totem = $this->totemRepository->findWithoutFail($id);

        if (empty($totem)) {
            Flash::error('Totem not found');

            return redirect(route('totems.index'));
        }

        $totem = $this->totemRepository->update($request->all(), $id);

        Flash::success('Totem updated successfully.');

        return redirect(route('totems.index'));
    }

    /**
     * Remove the specified Totem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $totem = $this->totemRepository->findWithoutFail($id);

        if (empty($totem)) {
            Flash::error('Totem not found');

            return redirect(route('totems.index'));
        }

        $this->totemRepository->delete($id);

        Flash::success('Totem deleted successfully.');

        return redirect(route('totems.index'));
    }




    public function updateStatus(Request $request)
    {
        $input = $request->all();

        $totem = Totem::whereName($input['name'])->first();
        
        if (is_null($totem))
        {
            return 'not found';
        }

        $now = Carbon::now();

        $totem->status = $input['status'];
        $totem->ip_addr = $input['ip_addr'];
        $totem->last_seen_at = $now;
        $totem->save();

        return 'ok';
    }











}
