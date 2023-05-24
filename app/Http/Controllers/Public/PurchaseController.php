<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use App\Repositories\PurchaseRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    public function __construct(
        private readonly PurchaseRepository $repository
    ) {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = request()->all();
        $purchases = $this->repository->list(params: $data);
        return inertia('Purchases/Index', compact('purchases', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->repository->getFormAttributes();
        return inertia('Purchases/Form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $this->repository->createWithRelations($request->validated());
        return redirect()->route('purchases.index')->with('success', 'Your purchase has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $pdf = Pdf::loadView('pdf.purchase', compact('purchase'));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $data = $this->repository->getFormAttributes($purchase->id);
        return inertia('Purchases/Form', $data);
        return redirect()->route('purchases.index')->with('success', 'Your purchase has been updated.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $this->repository->updateWithRelations($purchase->id, $request->validated());
        return redirect()->route('purchases.index')->with('success', 'Your purchase has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $this->repository->delete($purchase->id);
        return redirect()->route('purchases.index')->with('success', 'Your purchase has been deleted.');
    }
}
