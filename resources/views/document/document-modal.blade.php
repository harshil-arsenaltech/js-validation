<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="document_id" data-modal="documentModal" action="{{ route('document.store') }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        @csrf
                        <input type="hidden" name="id" value="">
                        {{-- <div class="form-group mb-3">
                            <input name="file" type="file" class="form-control">
                        </div> --}}
                        <div class="col-md-8">
                            <label>Name</label>
                            <input name="file" type="file" class="form-control"  class="form-control" validate>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mt-2 pull-right">
                        <button type="button" class="btn btn-primary modal-close-btn"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary submit-btn"> Save</button>
                        {{-- <button type="submit" class="btn btn-primary"> Save</button> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
