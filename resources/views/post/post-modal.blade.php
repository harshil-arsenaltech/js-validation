<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="post_id" data-modal="postModal" action="{{ route('post.store') }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="col-md-8">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" validate value="" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-8">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" validate value="" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-8">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" validate value="" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-8">
                            <label>Mobile Phone</label>
                            <input type="tel" name="mobile_number" validate class="form-control" value="" />
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
