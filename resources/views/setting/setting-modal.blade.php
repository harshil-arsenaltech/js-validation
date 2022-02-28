<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="setting_id" data-modal="settingModal" action="{{ route('setting.store') }}" method="post">
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
                        <div class="col-md-8">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" validate
                                data-required-error="Name field is required." value="" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-8">
                            <label>Value</label>
                            <input type="text" name="value" class="form-control" validate
                                data-required-error="Value field is required." value="" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mt-2 pull-right">
                        <button type="button" class="btn btn-primary modal-close-btn"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary submit-btn"> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
