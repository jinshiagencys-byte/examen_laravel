
<div class="row mt-2">
    <div class="col-lg-3 d-flex flex-row">
        <span>Affichage de {{ $model->total() > 0 ? ($model->currentPage() * $model->count()) - ($model->count() - 1) : 0 }} à {{ $model->currentPage() * $model->count() }} sur {{ $model->total() }} résultats</span>
    </div>
    <div class="col-lg-9 d-flex flex-row-reverse">
        {{ $model->links() }}
    </div>
</div>